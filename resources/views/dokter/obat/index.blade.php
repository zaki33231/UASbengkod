@extends('layout.main')
@section('title', 'Dokter Obat Page')

@section('isi')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manajemen Obat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manajemen Obat</h3>
                        </div>
                        <form method="POST" action="{{ route('dokter.obat.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namaObat">Nama Obat</label>
                                    <input type="text" name="nama_obat" class="form-control" id="namaObat"
                                        placeholder="Input obat's name">
                                </div>
                                <div class="form-group">
                                    <label for="kemasan">Kemasan</label>
                                    <input type="text" name="kemasan" class="form-control" id="kemasan"
                                        placeholder="Input kemasan's name">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="harga"
                                        placeholder="Input the price">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah Obat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Obat</h3>
                            <div class="card-tools">
                                <input type="text" class="form-control float-right" placeholder="Search">
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obat as $obat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $obat->id }}</td>
                                            <td>{{ $obat->nama_obat }}</td>
                                            <td>{{ $obat->kemasan }}</td>
                                            <td>{{ $obat->harga }}</td>
                                            <td class="d-flex ">
                                                <a href="{{ route('dokter.obat.edit', $obat->id) }} " type="button"
                                                    class="btn btn-warning mr-2">Edit</a>
                                                <form action="{{ route('dokter.obat.delete', $obat->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection