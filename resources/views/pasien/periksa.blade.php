@extends('layout.main')
@section('title', 'Daftar Poli')

@section('isi')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Poli</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Poli</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Form Pendaftaran -->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Poli</h3>
                            </div>
                            <form action="{{ route('pasien.periksa.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="no_rm">Nomor Rekam Medis</label>
                                        <input type="text" class="form-control" id="no_rm"
                                            value="{{ auth()->user()->pasien->no_rm ?? '' }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="poli">Pilih Poli</label>
                                        <select class="form-control @error('poli_id') is-invalid @enderror" id="poli"
                                            name="poli_id" required>
                                            <option value="">Pilih Poli</option>
                                            @foreach($polis as $poli)
                                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                            @endforeach
                                        </select>
                                        @error('poli_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jadwal">Pilih Jadwal</label>
                                        <select class="form-control @error('jadwal_id') is-invalid @enderror" id="jadwal"
                                            name="jadwal_id" required>
                                            <option value="">Pilih Jadwal</option>
                                        </select>
                                        @error('jadwal_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keluhan">Keluhan</label>
                                        <textarea class="form-control @error('keluhan') is-invalid @enderror" id="keluhan"
                                            name="keluhan" rows="3" required>{{ old('keluhan') }}</textarea>
                                        @error('keluhan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Riwayat Daftar Poli -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Daftar Poli</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Poli</th>
                                                <th>Dokter</th>
                                                <th>Hari</th>
                                                <th>Mulai</th>
                                                <th>Selesai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($riwayat as $index => $daftar)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $daftar->poli->nama_poli }}</td>
                                                    <td>{{ $daftar->jadwal->dokter->user->nama}}</td>
                                                    <td>{{ $daftar->jadwal->hari }}</td>
                                                    <td>{{ $daftar->jadwal->jam_mulai }}</td>
                                                    <td>{{ $daftar->jadwal->jam_selesai }}</td>
                                                    <td>{{ $daftar->status }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#poli').on('change', function () {
                var poliId = $(this).val();
                if (poliId) {
                    $.ajax({
                        url: '/pasien/get-jadwal/' + poliId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log('Data yang diterima:', data);
                            $('#jadwal').empty();
                            $('#jadwal').append('<option value="">Pilih Jadwal</option>');

                            if (data && data.length > 0) {
                                data.forEach(function (jadwal) {
                                    $('#jadwal').append(
                                        '<option value="' + jadwal.id + '">' +
                                        jadwal.dokter.nama + ' - ' +
                                        jadwal.hari + ' (' +
                                        jadwal.jam_mulai + ' - ' +
                                        jadwal.jam_selesai + ')</option>'
                                    );
                                });
                            } else {
                                $('#jadwal').append('<option value="" disabled>Tidak ada jadwal tersedia</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengambil jadwal');
                        }
                    });
                } else {
                    $('#jadwal').empty();
                    $('#jadwal').append('<option value="">Pilih Jadwal</option>');
                }
            });
        });
    </script>
@endpush