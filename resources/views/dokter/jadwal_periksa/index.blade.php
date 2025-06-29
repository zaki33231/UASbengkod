@extends('layout.main')

@section('title', 'Jadwal Periksa')

@section('isi')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            <i class="fas fa-calendar-alt ml-2"></i>
                            Jadwal Periksa
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Jadwal Periksa</li>
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
                        <h3 class="card-title">Daftar Jadwal Periksa</h3>
                        <div class="card-tools">
                            <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Jadwal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
                                        <th width="200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwal->hari }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $jadwal->status == 'Aktif' ? 'success' : 'danger' }}">
                                                    {{ $jadwal->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('dokter.jadwal-periksa.edit', $jadwal->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwal->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada jadwal periksa</td>
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
@endsection