@extends('layout.main')
@section('title', 'Daftar Riwayat Pasien')

@section('isi')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-primary">
                            <i class="fas fa-history mr-2"></i>
                            Daftar Riwayat Pasien
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" class="text-primary">Home</a></li>
                            <li class="breadcrumb-item active">Riwayat Pasien</li>
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

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list mr-2"></i>
                            Daftar Riwayat Pasien
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="tabelRiwayat">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" width="50">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>No. KTP</th>
                                        <th>No. Telepon</th>
                                        <th>No. RM</th>
                                        <th class="text-center" width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pasiens as $index => $pasien)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $pasien->nama }}</td>
                                            <td>{{ $pasien->alamat }}</td>
                                            <td>{{ $pasien->no_ktp }}</td>
                                            <td>{{ $pasien->no_hp }}</td>
                                            <td>{{ $pasien->no_rm }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('dokter.riwayat-pasien.detail', $pasien->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Tidak ada data pasien
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#tabelRiwayat').DataTable({
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