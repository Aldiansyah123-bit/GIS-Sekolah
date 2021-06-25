@extends('layouts.backend')

@section('judul1')
    {{$title ?? ''}}
@endsection

@section('judul2')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"> {{$title ?? ''}}</h1>
        </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>

            <div class="card-tools">
                <a href="/user/add" type="button" class="btn btn-primary btn-sm btn-flat">
                    <i class="fa fa-plus"></i>Add
                </a>
              </div>
        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{session('status')}}</h5>
                </div>
            @endif
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30px" class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th width="100px">Foto</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>  
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($user as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->password }}</td>
                                <td><img src="{{ asset('/storage/profile-photos') }}/{{basename($item->profile_photo_path)}}" width="70px"></td>
                                <td class="text-center">
                                    <a href="/user/edit/{{ $item->id}}" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{ $item->id}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>                  
                </table>
        </div>
        <!-- /.card-body -->
    </div>
 <!-- /.card -->
</div>

@foreach ($user as $item)
<div class="modal fade" id="delete{{ $item->id}}">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">{{ $item->name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Akan Menghapus Data ini ???</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                <a href="/user/delete/{{ $item->id}}" type="button" class="btn btn-outline-light">Yes</a>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

@endsection