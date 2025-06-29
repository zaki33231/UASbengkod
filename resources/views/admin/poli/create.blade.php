@extends('admin.layout.main')

@section('title', 'Tambah Poli')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-hospital-plus mr-2"></i>
                Tambah Poli Baru
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

            <form action="{{ route('admin.poli.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_poli">
                                <i class="fas fa-hospital mr-1"></i>
                                Nama Poli
                            </label>
                            <input type="text" class="form-control @error('nama_poli') is-invalid @enderror" id="nama_poli"
                                name="nama_poli" value="{{ old('nama_poli') }}" required>
                            @error('nama_poli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-info-circle mr-1"></i>
                                Keterangan
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            Simpan
                        </button>
                        <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection