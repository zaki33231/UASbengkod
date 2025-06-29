@extends('layout.main')

@section('title', 'Edit Jadwal Periksa')

@section('isi')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Jadwal Periksa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dokter.jadwal-periksa.index') }}">Jadwal
                                    Periksa</a></li>
                            <li class="breadcrumb-item active">Edit Jadwal</li>
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
                        <h3 class="card-title">Form Edit Jadwal</h3>
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

                        <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <select class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari"
                                    required>
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ old('hari', $jadwalPeriksa->hari) == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    id="jam_mulai" name="jam_mulai"
                                    value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i')) }}"
                                    required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    id="jam_selesai" name="jam_selesai"
                                    value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i')) }}"
                                    required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status', $jadwalPeriksa->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $jadwalPeriksa->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection