@extends('admin.layout.main')

@section('title', 'Kelola Poli')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-hospital mr-2"></i>
                Data Poli
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.poli.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Poli
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="poli-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($polis as $poli)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poli->nama_poli }}</td>
                            <td>{{ $poli->keterangan }}</td>
                            <td>
                                <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" class="d-inline">
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
                            <td colspan="4" class="text-center">Tidak ada data poli</td>
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
            $('#poli-table').DataTable({
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