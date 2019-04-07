<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
class KelasController extends Controller
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
    
    public function jsonkelas()
    {
        $kelas = Kelas::all();
        return Datatables::of($kelas)
        ->addColumn('action', function($kelas){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$kelas->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$kelas->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';
            })
        ->addColumn('checkbox', '<input type="checkbox" name="kelas_checkbox[]" class="kelas_checkbox" value="{{$id}}" />')
        ->rawColumns(['action','checkbox'])->make(true);
    }

    public function index()
    {
        return view('kelas.index');
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
            'kelas' => 'required',
            
        ],[
            'kelas.required'=>':Attribute harus diisi',
        ]);
        $data = new Kelas;
        $data->kelas = $request->kelas;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return $kelas;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'kelas' => 'required',
            
        ],[
            'kelas.required'=>':Attribute harus diisi',
        ]);
        $data = Kelas::findOrFail($id);
        $data->kelas = $request->kelas;
        $data->save();
        return response()->json(['success'=>true]);
    }

    public function removedata(Request $request)
    {
        $kelas = Kelas::find($request->input('id'));
        if($kelas->delete())
        {
            echo 'Data Deleted';
        }
    }

    function massremove(Request $request)
    {
        $kelas_array = $request->input('id');
        $kelas = Kelas::whereIn('id', $kelas_array);
        if($kelas->delete())
        {
            echo 'Data Deleted';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
