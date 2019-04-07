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
                     <label>Tanggal Pinjam Buku</label>
                     <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" readonly>
                     <span class="help-block has-error tanggal_pinjam_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Harus Kembali Buku</label>
                     <input type="date" name="tanggal_harus_kembali" id="tanggal_harus_kembali" class="form-control" readonly>
                     <span class="help-block has-error tanggal_harus_kembali_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Kembali Buku</label>
                     <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" >
                     <span class="help-block has-error tanggal_kembali_error"></span>
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