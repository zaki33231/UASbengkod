@extends('admin.layout.main')

@section('title', 'Edit Pasien')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-edit mr-2"></i>
                Edit Data Pasien
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

            <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">
                                <i class="fas fa-user mr-1"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $pasien->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_ktp">
                                <i class="fas fa-id-card mr-1"></i>
                                Nomor KTP
                            </label>
                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp"
                                name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" required>
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Alamat
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp">
                                <i class="fas fa-phone mr-1"></i>
                                Nomor HP
                            </label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope mr-1"></i>
                                Email
                            </label>
                            <input type="email" class="form-control" value="{{ $pasien->user->email }}" disabled>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Email tidak dapat diubah
                            </small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock mr-1"></i>
                        Password Baru (Opsional)
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Kosongkan jika tidak ingin mengubah password.
                    </small>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            Update
                        </button>
                        <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection