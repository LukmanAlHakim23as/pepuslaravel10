@extends('layouts.app')

@section('main')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Peminjjaman</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Peminjaman</th>
                                    <th>Admin</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamen as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $peminjaman->buku->judul }}</td>
                                        <td>{{ $peminjaman->user->name }}</td>
                                        <td>{{ $peminjaman->admin->name }}</td>
                                        <td>{{ $peminjaman->created_at->format('d M Y')}}</td>
                                        <td>{{ isset($peminjaman->tgl_kembali)? 'selesai' : 'dipinjam'}}</td> }}</td>
                                        <td>
                                            <form action="{{ route('datapeminjaman.update', $peminjaman) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                                                <input type="hidden" name="buku_id" value="{{ $peminjaman->buku->id }}">
                                                <button type="submit" class="btn btn-danger">Kembali</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('datapeminjaman.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="buku_id">Judul</label>
                        <select class="form-select" id="buku_id" name="buku_id"">
                            @foreach ($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Peminjam</label>
                        <select class="form-select" id="user_id" name="user_id"">
                            @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
