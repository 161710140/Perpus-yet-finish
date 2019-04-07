<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="Modal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="form" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_tampil"></span>
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                     <label>Nomor Absen</label>
                     <input type="text" name="no_absen" id="no_absen" class="form-control" 
                     placeholder="Masukan Nomor Absen Siswa">
                     <span class="help-block has-error no_absen_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Nomor Induk</label>
                     <input type="text" name="no_induk" id="no_induk" class="form-control" 
                     placeholder="Masukan Nomor Induk Siswa">
                     <span class="help-block has-error no_induk_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Nama Siswa</label>
                     <input type="text" name="nama" id="nama" class="form-control"
                      placeholder="Masukan Nama Siswa">
                     <span class="help-block has-error nama_error"></span>
                  </div>
                  <div class="form-group {{ $errors->has('id_kelas') ? 'has-error' : '' }}">
                     <label>Nama Kelas</label>
                     <select class="form-control select-dua" name="id_kelas" id="id_kelas" style="width: 468px">
                        <option disabled selected>Pilih Kelas</option>
                        @foreach($kelas as $data)
                        <option value="{{$data->id}}">{{$data->kelas}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('suplier_id'))
                     <span class="help-block has-error id_kelas_error">
                        <strong>{{$errors->first('id_kelas')}}</strong>
                     </span>
                     @endif
                  </div>
				<div class="modal-footer">
					<input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
					<input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
				</div>
               </form>
            </div>
         </div>
      </div>
</body>
</html>