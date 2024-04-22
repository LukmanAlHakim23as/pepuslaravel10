@extends('layouts.app')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ $buku->cover }}" alt="cover">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title"></h1>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="150px">Judul</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->judul }}</th>
                            </tr>
                            <tr>
                                <th width="150px">Kategori</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->kategori->name }}</th>

                            </tr>
                            <tr>
                                <th width="150px">Penulis</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->penulis }}</th>
                            </tr>
                            <tr>
                                <th width="150px">Penerbit</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->penerbit }}</th>
                            </tr>
                            <tr>
                                <th width="150px">Deskripsi</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->deskripsi }}</th>
                            </tr>
                            <tr>
                                <th width="150px">Stok</th>
                                <th width="50px">:</th>
                                <th>{{ $buku->stok }}</th>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
