@extends('admin.layout.main')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_poli }}</h3>
                    <p>Total Poli</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <a href="{{ route('admin.poli.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_dokter }}</h3>
                    <p>Total Dokter</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="{{ route('admin.dokter.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_pasien }}</h3>
                    <p>Total Pasien</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.pasien.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $total_obat }}</h3>
                    <p>Total Obat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pills"></i>
                </div>
                <a href="{{ route('admin.obat.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Menu Cepat
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary btn-block mb-3">
                                <i class="fas fa-user-md mr-2"></i>
                                Tambah Dokter
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="{{ route('admin.poli.create') }}" class="btn btn-success btn-block mb-3">
                                <i class="fas fa-hospital mr-2"></i>
                                Tambah Poli
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="{{ route('admin.pasien.create') }}" class="btn btn-warning btn-block mb-3">
                                <i class="fas fa-user-plus mr-2"></i>
                                Tambah Pasien
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="{{ route('admin.obat.create') }}" class="btn btn-danger btn-block mb-3">
                                <i class="fas fa-pills mr-2"></i>
                                Tambah Obat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection