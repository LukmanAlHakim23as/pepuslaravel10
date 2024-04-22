@extends('layouts.app')

@section('main')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
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
                                <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal"
                                    data-target="#modal-default">
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="d-flex flex-row">
                                                <form action="{{ route('datauser.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm ('apakah data akan di hapus?')"><i
                                                        class="fa fa-trash"></i></a></button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalEdit{{ $user->id }}"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('datauser.store') }}" method="POST"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="judul">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        required>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="cover">cover</label>
                                                    <input type="file" class="form-control" id="cover" name="cover" required>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="penulis">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="penerbit">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="deskripsi">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="stok">Role</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        class="form-control" id="role" name="role" required>
                                                        <option value="member">Member</option>
                                                        <option value="pustakawan">Pustakawan</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modalEdit{{ $user->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('datauser.update', $user) }}" method="POST"
                                                class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="judul">Nama</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $user->name }}" required>
                                                </div>
                                                {{-- <div class="form-group">
                        <label for="cover">cover</label>
                        <input type="file" class="form-control" id="cover" name="cover" required>
                    </div> --}}
                                                <div class="form-group">
                                                    <label for="penulis">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" value="{{ $user->username }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="penerbit">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ $user->email }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="stok">Role</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        class="form-control" id="role" name="role"
                                                        value="{{ $user->role }}" required>
                                                        @if ($user->role == 'member')
                                                            <option value="member" selected>Anggota</option>
                                                            <option value="pustakawan">Pustakawan</option>
                                                            <option value="admin">Admin</option>
                                                        @elseif($user->role == 'pustakawan')
                                                            <option value="pustakawan" selected>Pustakawan</option>
                                                            <option value="member">Anggota</option>
                                                            <option value="admin">Admin</option>
                                                        @elseif($user->role == 'admin')
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="member">Anggota</option>
                                                            <option value="pustakawan">Pustakawan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
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
