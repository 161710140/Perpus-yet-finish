<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
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
    
    public function json()
    {
        $siswa = Siswa::all();
        return Datatables::of($siswa)
        ->addColumn('kelas', function($siswa){
            return $siswa->kelas->kelas;
        })
        ->addColumn('action', function($siswa){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$siswa->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$siswa->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';
            })
        ->addColumn('checkbox', '<input type="checkbox" name="siswa_checkbox[]" class="siswa_checkbox" value="{{$id}}" />')
        ->rawColumns(['action','kelas','checkbox'])->make(true);
    
    }

    public function index()
    {
        $kelas = Kelas::all();
        return view('Siswa.index',compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'no_absen' => 'required|numeric',
            'nama' => 'required',
            'id_kelas' => 'required',
            'no_induk' => 'required|numeric',
        ],[
            'no_absen.required'=>':Attribute harus diisi',
            'nama.required'=>':Attribute harus diisi',
            'id_kelas.required'=>':Attribute harus diisi',
            'no_induk.required'=>':Attribute harus diisi',
            'no_induk.numeric'=>':Attribute harus dengan Angka',
            'no_absen.numeric'=>':Attribute harus diisi dengan Angka'
        ]);
        $data = new Siswa;
        $data->no_absen = $request->no_absen;
        $data->nama = $request->nama;
        $data->id_kelas = $request->id_kelas;
        $data->no_induk = $request->no_induk;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return $siswa;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'no_absen' => 'required|numeric',
            'nama' => 'required',
            'id_kelas' => 'required',
            'no_induk' => 'required|numeric',
        ],[
            'no_absen.required'=>':Attribute harus diisi',
            'nama.required'=>':Attribute harus diisi',
            'id_kelas.required'=>':Attribute harus diisi',
            'no_induk.required'=>':Attribute harus diisi',
            'no_induk.numeric'=>':Attribute harus dengan Angka',
            'no_absen.numeric'=>':Attribute harus diisi dengan Angka'
        ]);
        $data = Siswa::findOrFail($id);
        $data->no_absen = $request->no_absen;
        $data->nama = $request->nama;
        $data->id_kelas = $request->id_kelas;
        $data->no_induk = $request->no_induk;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */

    public function removedata(Request $request)
    {
        $siswa = Siswa::find($request->input('id'));
        if($siswa->delete())
        {
            echo 'Data Deleted';
        }
    }

    function massremove(Request $request)
    {
        $siswa_array = $request->input('id');
        $siswa = Siswa::whereIn('id', $siswa_array);
        if($siswa->delete())
        {
            echo 'Data Deleted';
        }
    }

    public function destroy(Siswa $siswa)
    {
        //
    }
}
