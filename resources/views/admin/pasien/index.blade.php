@extends('admin.layout.main')

@section('title', 'Kelola Pasien')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users mr-2"></i>
                Data Pasien
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pasien.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah Pasien
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="pasien-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>KTP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasiens as $pasien)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pasien->nama }}</td>
                                <td>{{ $pasien->email }}</td>
                                <td>{{ $pasien->no_ktp }}</td>
                                <td>
                                    <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST"
                                        class="d-inline">
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
                                <td colspan="8" class="text-center">Tidak ada data pasien</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pasiens->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#pasien-table').DataTable({
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