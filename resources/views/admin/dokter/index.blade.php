@extends('admin.layout.main')

@section('title', 'Kelola Dokter')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-md mr-2"></i>
                Data Dokter
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah Dokter
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="dokter-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nama Poli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokters as $dokter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dokter->nama }}</td>
                            <td>{{ $dokter->email }}</td>
                            <td>{{ $dokter->nama_poli }}</td>
                            <td>
                                <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data dokter</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dokter-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endpush