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
                  <div class="form-group {{ $errors->has('id_kelas') ? 'has-error' : '' }}">
                     <label>Nama Kelas</label>
                     <select class="form-control select-dua" name="id_kelas" id="id_kelas" style="width: 468px">
                        <option disabled selected>Pilih Kelas</option>
                        @foreach($kelas as $data)
                        <option value="{{$data->id}}">{{$data->kelas}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_kelas'))
                     <span class="help-block has-error id_kelas_error">
                        <strong>{{$errors->first('id_kelas')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group">
                <label for="name">Nama Siswa</label>
                <select name="id_siswa" id="id_siswa"class="form-control select-dua" style="width:350px">
                </select>
                  <div class="form-group {{ $errors->has('id_buku') ? 'has-error' : '' }}">
                     <label>Buku</label>
                     <select class="form-control select-dua" name="id_buku" id="id_buku" style="width: 468px">
                        <option disabled selected>Pilih Buku Yang Ingin Di Pinjam</option>
                        @foreach($buku as $data)
                        <option value="{{$data->id}}">{{$data->judul}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_buku'))
                     <span class="help-block has-error id_kelas_error">
                        <strong>{{$errors->first('id_buku')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Tanggal Pinjam Buku</label>
                     <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" 
                     value="<?php echo Carbon\Carbon::now()->format('Y-m-d') ?>" readonly>
                     <span class="help-block has-error tanggal_pinjam_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Harus Kembali Buku</label>
                     <input type="date" name="tanggal_harus_kembali" id="tanggal_harus_kembali" class="form-control"
                     value="<?php echo Carbon\Carbon::now()->addDays(3)->format('Y-m-d') ?>" readonly>
                     <span class="help-block has-error tanggal_harus_kembali_error"></span>
                  </div>
				<div class="modal-footer">
					<input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
					<input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
				</div>
               </form>
            </div>
         </div>
      </div>
      <script>
      $(document).ready(function() {
        $('select[name="id_kelas"]').on('change', function() {
            var kelas = $(this).val();
            if(kelas) {
                $.ajax({
                    url: 'nama/'+kelas,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="id_siswa"]').empty();
                        $.each(data.kelas, function(key, value) {
                            $('select[name="id_siswa"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="id_siswa"]').empty();
            }
        });
    });
      </script>
      
</body>
</html>