@extends('layout.main')

@section('title', 'Tambah Jadwal Periksa')

@section('isi')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Jadwal Periksa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dokter.jadwal-periksa.index') }}">Jadwal
                                    Periksa</a></li>
                            <li class="breadcrumb-item active">Tambah Jadwal</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Jadwal</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('dokter.jadwal-periksa.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <select class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari"
                                    required>
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai (Format 24 jam)</label>
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                                <small class="form-text text-muted">Gunakan format 24 jam (00:00 - 23:59)</small>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai (Format 24 jam)</label>
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                                <small class="form-text text-muted">Gunakan format 24 jam (00:00 - 23:59)</small>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Force 24-hour format for time inputs
            document.getElementById('jam_mulai').setAttribute('step', '60');
            document.getElementById('jam_selesai').setAttribute('step', '60');
        });
    </script>
@endsection