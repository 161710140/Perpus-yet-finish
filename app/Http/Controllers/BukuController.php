<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use Session;
class BukuController extends Controller
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

    public function jsonbuku()
    {
        $buku = Buku::all();
        return Datatables::of($buku)
        ->addColumn('action', function($buku){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$buku->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$buku->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';
            })
        ->addColumn('checkbox', '<input type="checkbox" name="buku_checkbox[]" class="buku_checkbox" value="{{$id}}" />')
        ->rawColumns(['action','checkbox'])->make(true);
    
    }

    public function index()
    {
        return view('Buku.index');
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
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required',
            'tersedia' => 'required|not_in:0',
            
        ],[
            'judul.required'=>':Attribute harus diisi',
            'pengarang.required'=>':Attribute harus diisi',
            'tahun_terbit.required'=>':Attribute harus diisi',
            'tahun_terbit.numeric'=>':Attribute harus berupa angka',
            'penerbit.required'=>':Attribute harus diisi',
            'tersedia.required'=>':Attribute harus diisi',
            'tersedia.not_in'=>'Jumlah Buku  tidak boleh 0',
        ]);
        $data = new Buku;
        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->tahun_terbit = $request->tahun_terbit;
        $data->penerbit = $request->penerbit;
        $data->tersedia = $request->tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return $buku;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required',
            'tersedia' => 'required',
            
        ],[
            'judul.required'=>':Attribute harus diisi',
            'pengarang.required'=>':Attribute harus diisi',
            'tahun_terbit.required'=>':Attribute harus diisi',
            'tahun_terbit.numeric'=>':Attribute harus berupa angka',
            'penerbit.required'=>':Attribute harus diisi',
            'tersedia.required'=>':Attribute harus diisi',
        ]);
        $data = Buku::findOrFail($id);
        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->tahun_terbit = $request->tahun_terbit;
        $data->penerbit = $request->penerbit;
        $data->tersedia = $request->tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    public function removedata(Request $request)
    {

        $buku = Buku::find($request->input('id'));
        if($buku->delete())
        {
            echo 'Data Deleted';
        }
        if(!$buku->delete()) return redirect()->back();
    }

    function massremove(Request $request)
    {
        $buku_array = $request->input('id');
        $buku = Buku::whereIn('id', $buku_array);
        if($buku->delete())
        {
            echo 'Data Deleted';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //
    }
}
