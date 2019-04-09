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
              <h1 class="card-title">Buku</h1>
              <button type="button" name="add" id="Tambah" class="btn btn-primary pull-right" style="margin-left: 960px; margin-top: 10px; margin-bottom: 10px">Add Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tab_buku" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Penerbit</th>
                        <th>Tersedia</th>
                        <th>Action</th>
                        <th><button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove">Delete Selected</i></button></th>
                        <th>Select All : <input id="checkall" class='' type="checkbox" >
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

@include('Buku.modal')
      <script type="text/javascript">
         $(document).ready(function() {
          $.LoadingOverlay('show',{
          image:"{{asset('a.gif')}}",
          text:"Mohon Tunggu....",
          textAnimation: "1500ms fadein"
        });
          $('#tab_buku').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/jsonbuku',
            columns:[
                  { data: 'judul', name: 'judul' },
                  { data: 'pengarang', name: 'pengarang' },
                  { data: 'tahun_terbit', name: 'tahun_terbit' },
                  { data: 'penerbit', name: 'penerbit' },
                  { data: 'tersedia', name: 'tersedia' },
                  { data: 'action', orderable: false, searchable: false },
                  { data: "checkbox", orderable:false, searchable:false},

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
                url: "{{url ('/storebuku')}}",
                data: new FormData(this),
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
                  $('#tab_buku').DataTable().ajax.reload();
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
                url: "{{url ('buku/edit')}}"+ '/' + $('#id').val(),
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
                  $('#tab_buku').DataTable().ajax.reload();
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
              url:"{{url('buku/getedit')}}" + '/' + bebas,
              method:'get',
              data:{id:bebas},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";

                $('#id').val(data.id);
                $('#judul').val(data.judul);
                $('#pengarang').val(data.pengarang);
                $('#tahun_terbit').val(data.tahun_terbit);
                $('#penerbit').val(data.penerbit);
                $('#tersedia').val(data.tersedia);
                $('#Modal').modal('show');
                $('#aksi').val('Simpan');
                $('.modal-title').text('Edit Data');
                }
              });
          });

          $(document).on('hide.bs.modal','#Modal', function() {
            $('#tab_buku').DataTable().ajax.reload();
          });

          //proses delete data
          $(document).on('click', '.delete', function(){
            var bebas = $(this).attr('id');
              if (confirm("Yakin Dihapus ?")) {

                $.ajax({
                  url: "{{route('ajaxdata.removedatabuku')}}",
                  method: "get",
                  data:{id:bebas},
                  success: function(data){
                    swal({
                      title:'Success Delete!',
                      text:'Data Berhasil Dihapus',
                      type:'success',
                      timer:'1500'
                    });
                    $('#tab_buku').DataTable().ajax.reload();
                  }
                })
              }
              else
              {
                swal({
                  title:'Batal',
                  text:'Data Tidak Jadi Dihapus',
                  type:'error',
                  });
                return false;
              }
            });

          $(document).on('click', '#bulk_delete', function(){
          var id = [];
          if(confirm("Apakah Anda Yakin Ingin Menghapus Data Yang Dipilih?"))
          {
            $('.buku_checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0)
            {
                $.ajax({
                    url:"{{ route('ajaxdata.massremovebuku')}}",
                    method:"get",
                    data:{id:id},
                    success:function(data)
                    {
                        alert(data);
                        $('#tab_buku').DataTable().ajax.reload();
                    }
                });
            }
            else

            {
                alert("Mohon Pilih Data Yang Ingin Dihapus");
            }

           }
        });

    $("#checkall").click(function (){
     if ($("#checkall").is(':checked')){
        $(".buku_checkbox").each(function (){
           $(this).prop("checked", true);
           });
        }else{
           $(".buku_checkbox").each(function (){
                $(this).prop("checked", false);
           });
        }
     });
    });
      </script>
@endpush