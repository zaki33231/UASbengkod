@extends('admin.layout.main')

@section('title', 'Tambah Dokter')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-md mr-2"></i>
                Tambah Dokter Baru
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">
                                <i class="fas fa-user mr-1"></i>
                                Nama Dokter
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope mr-1"></i>
                                Email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock mr-1"></i>
                                Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-lock mr-1"></i>
                                Konfirmasi Password
                            </label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Alamat
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_hp">
                                <i class="fas fa-phone mr-1"></i>
                                No HP
                            </label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="poli_id">
                                <i class="fas fa-hospital mr-1"></i>
                                Poli
                            </label>
                            <select class="form-control @error('poli_id') is-invalid @enderror" id="poli_id" name="poli_id"
                                required>
                                <option value="">Pilih Poli</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ old('poli_id') == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                            @error('poli_id')
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
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection