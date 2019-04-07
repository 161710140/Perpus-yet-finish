<?php

namespace App\Http\Controllers;

use App\PinjamBuku;
use App\Kelas;
use App\Buku;
use App\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;
class PinjamBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function jsonpinjam()
    {
        $pinjam = PinjamBuku::where('tanggal_kembali','=',null);
        return Datatables::of($pinjam)
        ->addColumn('siswa', function($pinjam){
            return $pinjam->Siswa->nama;
        })
        ->addColumn('kelas', function($pinjam){
            return $pinjam->Kelas->kelas;
        })
        ->addColumn('buku', function($pinjam){
            return $pinjam->Buku->judul;
        })
        ->rawColumns(['kelas','buku','siswa'])->make(true);
    }

    public function jsonpengembalian()
    {
        $PINJAM = PinjamBuku::all();
        return Datatables::of($PINJAM)
        ->addColumn('siswa', function($PINJAM){
            return $PINJAM->Siswa->nama;
        })
        ->addColumn('buku', function($PINJAM){
            return $PINJAM->Buku['judul'];
        })
        ->editColumn('hukuman',function($PINJAM){
            if ($PINJAM->tanggal_kembali == null) {
                return '';
            }
                if ($PINJAM->tanggal_kembali > $PINJAM->tanggal_harus_kembali) {
                    return '<font color="red"><b>TERLAMBAT!</font></b>';
                }else{
                    return '<font color="green"><b>Tidak Terlambat</font></b>';
                }
                if ($PINJAM->tanggal_kembali == $PINJAM->tanggal_harus_kembali) {
                    return '<font color="blue"><b>Tepat Waktu</font></b>';
                }
            })
            ->addColumn('action', function($kelas){
                return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$kelas->id.'">
                <i class="glyphicon glyphicon-edit"></i>Kembalikan</a>&nbsp';
                })    
        ->rawColumns(['siswa','buku','hukuman','action'])->make(true);
    }

    public function countbuku($value='')
    {
        PinjamBuku::count();
        $count = PinjamBuku::count();
        return View::make('home2')->with('count', $count);

    }

    public function index()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        $buku = Buku::all();
        return view('PinjamBuku.index',compact('kelas','siswa','buku'));
    }

    public function index2()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        $buku = Buku::all();
        return view('PinjamBuku.index2',compact('kelas','siswa','buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'id_kelas' => 'required',
            'id_siswa' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_harus_kembali' => 'required',
        ],[
            'id_buku.required'=>':Attribute harus diisi',
            'id_siswa.required'=>':Attribute harus diisi',
            'id_kelas.required'=>':Attribute harus diisi',
            'tanggal_pinjam.required'=>':Attribute harus diisi',
            'tanggal_harus_kembali.required'=>':Attribute harus diisi',
        ]);
        $data = new PinjamBuku;
        $data->id_buku = $request->id_buku;
        $data->id_siswa = $request->id_siswa;
        $data->id_kelas = $request->id_kelas;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->tanggal_harus_kembali = $request->tanggal_harus_kembali;
        $data->save();

        $stok = Buku::where('id', $data->id_buku)->first();
        $stok->tersedia = $stok->tersedia - 1;
        $stok->save();
        return response()->json(['success'=>true]);
    }

    public function store2(Request $request)
    {
        $this->validate($request, [
            'tanggal_kembali' => 'required',
        ],[
            'tanggal_harus_kembali.required'=>':Attribute harus diisi',
        ]);
        $data = new PinjamBuku;
        $data->hukuman = $request->hukuman;
        $data->tanggal_kembali = $request->tanggal_kembali;
        $data->save();
        return response()->json(['success'=>true]);
        $stok->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function show(PinjamBuku $pinjamBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);
        return $pinjam;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'id_kelas' => 'required',
            'id_siswa' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_harus_kembali' => 'required',
        ],[
            'id_buku.required'=>':Attribute harus diisi',
            'id_siswa.required'=>':Attribute harus diisi',
            'id_kelas.required'=>':Attribute harus diisi',
            'tanggal_pinjam.required'=>':Attribute harus diisi',
            'tanggal_harus_kembali.required'=>':Attribute harus diisi',
        ]);
        $data = PinjamBuku::findOrFail($id);
        $data->id_buku = $request->id_buku;
        $data->id_siswa = $request->id_siswa;
        $data->id_kelas = $request->id_kelas;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->tanggal_harus_kembali = $request->tanggal_harus_kembali;
        $data->save();
        $stok = Buku::where('id', $data->id_buku)->first();
        $stok->tersedia = $stok->tersedia + 1;
        $stok->save();
        return response()->json(['success'=>true]);
    }

    public function update2(Request $request,$id)
    {
        $this->validate($request, [
            'tanggal_kembali' => 'required',
        ],[
            'tanggal_kembali.required'=>':Attribute harus diisi',
        ]); 
        $data = PinjamBuku::findOrFail($id);
        $data->tanggal_kembali = $request->tanggal_kembali;
        $data->save();
        return response()->json(['success'=>true]);
    }
    public function KelasSiswa($id)
    {
        $id_sub = DB::table("kelas")
        ->join('siswas','kelas.id','=','siswas.id_kelas')
        ->where("kelas.id",$id)
        ->orderBy("siswas.id","asc")
        ->first();

        $siswa = DB::table("kelas")
        ->join('siswas','kelas.id','=','siswas.id_kelas')
        ->where("siswas.id_kelas",$id_sub->id_kelas)
        ->pluck("siswas.nama","siswas.id");


        $data['kelas']=$siswa;
        $data['id_sub']=$id_sub;
        return json_encode($data);
    }

    public function getedit($id)
    {
        $pinjam = PinjamBuku::find($id);
        $data['id_buku']=$pinjam->Buku->judul;
        $data['tanggal_pinjam']=$pinjam->tanggal_pinjam;
        $data['tanggal_harus_kembali']=$pinjam->tanggal_harus_kembali;
        return json_encode($data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(PinjamBuku $pinjamBuku)
    {
        //
    }
}
