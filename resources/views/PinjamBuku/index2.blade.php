@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Pengembalian</h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <div align="center">
                <a href="{{ route('export_excel.excel') }}" class="btn btn-success">Export to Excel
                </a>
                </div>
              <table id="tab_pinjam" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th>Nama Siswa</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Tanggal Harus Kembali Buku</th>
                        <th>Status</th>
                     </tr>
                  </thead>
               </table>
            </div>
          </div>
        </div>
      </div>
    </section> 
  </div>
@endsection
@push('scripts')

@include('PinjamBuku.modal2')
      <script type="text/javascript">
         $(document).ready(function() {
          $.LoadingOverlay('show',{
          image:"{{asset('a.gif')}}",
          text:"Mohon Tunggu....",
          textAnimation: "1500ms fadein"
        });
          $('#tab_pinjam').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/jsonpengembalian',
            columns:[
                  { data: 'siswa'},
                  { data: 'buku'},
                  { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                  { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                  { data: 'tanggal_harus_kembali', name: 'tanggal_harus_kembali' },
                  { data: 'hukuman', name: 'hukuman' },
              ],
            });
            setTimeout(function(){
          $.LoadingOverlay("hide");
          }, 3000);
          $('#Tambah').click(function(){

            $('#Modal').modal('show');
            $('.modal-title').text('Add Data');
            $('#aksi').val('Tambah');
            $('.select-dua').select2();
            state = "insert";

            });

           $('#Modal').on('hidden.bs.modal',function(e){
            $(this).find('#form')[0].reset();
            $('span.has-error').text('');
            $('.form-group.has-error').removeClass('has-error');
            });

          $('#form').submit(function(e){
            $.ajaxSetup({
              header: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
              }
            });

            //menambah kan data
            e.preventDefault();

            if (state == 'insert'){

              $.ajax({
                type: "POST",
                url: "{{url ('/storepengembalian')}}",
                data: new FormData(this),
               // data: $('#student_form').serialize(),
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function (data){
                  console.log(data);
                  swal({
                      title:'Success Tambah!',
                      text: data.message,
                      type:'success',
                      timer:'2000'
                    });
                  $('#Modal').modal('hide');
                  $('#tab_pinjam').DataTable().ajax.reload();
                },

                //menampilkan validasi error
                error: function (data){

                  $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });

                  var coba = new Array();
                  console.log(data.responseJSON.errors);
                  $.each(data.responseJSON.errors,function(name, value){
                    console.log(name);
                    coba.push(name);

                    $('input[name='+name+']').parent().addClass('has-error');
                    $('input[name='+name+']').next('.help-block').show().text(value);
                  });

                  $('input[name='+coba[0]+']').focus();
                }
              });
            }
            else 
            {
               //mengupdate data yang telah diedit
              $.ajax({
                type: "POST",
                url: "{{url ('pinjamm/edit')}}"+ '/' + $('#id').val(),
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data){
                  console.log(data);
                  $('#Modal').modal('hide');
                  swal({
                    title: 'Update Success',
                    text: data.message,
                    type: 'success',
                    timer: '3500'
                  })
                  $('#tab_pinjam').DataTable().ajax.reload();
                },
                error: function (data){
                    swal({
                    title: 'Update Error',
                    text: 'Oops...',
                    type: 'error',
                    timer: '3500'
                  })                  
                  $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });
                  var coba = new Array();
                  console.log(data.responseJSON.errors);
                  $.each(data.responseJSON.errors,function(name, value){
                    console.log(name);
                    coba.push(name);
                    $('input[name='+name+']').parent().addClass('has-error');
                    $('input[name='+name+']').next('.help-block').show().text(value);
                  });

                  $('input[name='+coba[0]+']').focus();
                }
             });
            }
         });

          //mengambil data yang ingin diedit
          $(document).on('click', '.edit', function(){
            var bebas = $(this).data('id');
            $('#form_tampil').html('');
            $.ajax({
              url:"{{url('pinjam/getedit')}}" + '/' + bebas,
              method:'get',
              data:{id:bebas},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";

                $('#id').val(data.id);
                $('#Modal').modal('show');
                $('#tanggal_pinjam').val(data.tanggal_pinjam);
                $('#tanggal_harus_kembali').val(data.tanggal_harus_kembali);
                $('#aksi').val('Simpan');
                $('.modal-title').text('Edit Data');
                }
              });
          });

          $(document).on('hide.bs.modal','#Modal', function() {
            $('#tab_pinjam').DataTable().ajax.reload();
          });
       });
      </script>
@endpush