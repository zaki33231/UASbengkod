@extends('admin.layout.main')

@section('title', 'Edit Obat')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Edit Data Obat
            </h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_obat">
                                <i class="fas fa-prescription-bottle mr-1"></i>
                                Nama Obat
                            </label>
                            <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat"
                                name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                            @error('nama_obat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kemasan">
                                <i class="fas fa-box mr-1"></i>
                                Kemasan
                            </label>
                            <input type="text" class="form-control @error('kemasan') is-invalid @enderror" id="kemasan"
                                name="kemasan" value="{{ old('kemasan', $obat->kemasan) }}" required>
                            @error('kemasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga">
                                <i class="fas fa-tag mr-1"></i>
                                Harga
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                    name="harga" value="{{ old('harga', $obat->harga) }}" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            Update
                        </button>
                        <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection