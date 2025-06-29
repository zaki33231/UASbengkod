@extends('layout.main')
@section('title', 'Detail Riwayat Pasien')

@section('isi')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-primary">
                            <i class="fas fa-user-clock mr-2"></i>
                            Detail Riwayat Pasien
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" class="text-primary">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dokter.riwayat-pasien') }}"
                                    class="text-primary">Riwayat Pasien</a></li>
                            <li class="breadcrumb-item active">Detail Riwayat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Data Pasien
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="200" class="text-muted">
                                                    <i class="fas fa-user mr-2"></i>
                                                    Nama Pasien
                                                </th>
                                                <td>: {{ $pasien->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">
                                                    <i class="fas fa-fingerprint mr-2"></i>
                                                    No. RM
                                                </th>
                                                <td>: {{ $pasien->no_rm }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">
                                                    <i class="fas fa-id-card mr-2"></i>
                                                    No. KTP
                                                </th>
                                                <td>: {{ $pasien->no_ktp }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="200" class="text-muted">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    Alamat
                                                </th>
                                                <td>: {{ $pasien->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">
                                                    <i class="fas fa-phone mr-2"></i>
                                                    No. Telepon
                                                </th>
                                                <td>: {{ $pasien->no_hp }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-2"></i>
                            Riwayat Pemeriksaan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="tabelRiwayatPeriksa">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" width="50">No</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Keluhan</th>
                                        <th>Catatan</th>
                                        <th>Obat</th>
                                        <th class="text-right">Biaya Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatPeriksa as $index => $riwayat)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d/m/Y') }}</td>
                                            <td>{{ $riwayat->daftarPoli->keluhan ?? '-' }}</td>
                                            <td>{{ $riwayat->catatan }}</td>
                                            <td>
                                                @if($riwayat->obats && count($riwayat->obats))
                                                    <ul>
                                                        @foreach($riwayat->obats as $obat)
                                                            <li>{{ $obat->nama_obat }} ({{ $obat->jumlah }} x
                                                                Rp{{ number_format($obat->harga, 0, ',', '.') }})</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-info-circle mr-1"></i>
                                                        Tidak ada obat
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bold">
                                                    Rp {{ number_format($riwayat->total_biaya, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Tidak ada data riwayat pemeriksaan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3 mb-5">
                    <a href="{{ route('dokter.riwayat-pasien') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#tabelRiwayatPeriksa').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "search": "Cari:",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection