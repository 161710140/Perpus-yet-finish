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
                     <label>Judul</label>
                     <input type="text" name="judul" id="judul" class="form-control" 
                     placeholder="Nama Judul Buku">
                     <span class="help-block has-error judul_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Pengarang</label>
                     <input type="text" name="pengarang" id="pengarang" class="form-control" 
                     placeholder="Nama Pengarang">
                     <span class="help-block has-error pengarang_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tahun Terbit</label>
                     <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" 
                     placeholder="Tahun Terbit Buku">
                     <span class="help-block has-error tahun_terbit_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Penerbit</label>
                     <input type="text" name="penerbit" id="penerbit" class="form-control" 
                     placeholder="Penerbit Buku">
                     <span class="help-block has-error penerbit_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Jumlah Buku</label>
                     <input type="number" min="0" name="tersedia" id="tersedia" class="form-control" 
                     placeholder="Jumlah Buku">
                     <span class="help-block has-error tersedia_error"></span>
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