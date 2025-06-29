@extends('layout.main')
@section('title', 'Dashboard Pasien')

@section('isi')
  <div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard Pasien</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
      </div>
    </div>
    </div>

    <section class="content">
    <div class="container-fluid">
      <div class="row">
      <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
          <h5>Selamat Datang, {{ Auth::user()->nama }}!</h5>
          <p>Nomor Rekam Medis Anda: {{ Auth::user()->pasien->no_rm }}</p>
        </div>
        </div>
      </div>
      </div>

      <div class="row">
      <div class="col-lg-12">
        <div class="small-box bg-info">
        <div class="inner">
          <h3>Daftar Poli</h3>
          <p>Daftar untuk pemeriksaan</p>
        </div>
        <div class="icon">
          <i class="fas fa-stethoscope"></i>
        </div>
        <a href="{{ route('pasien.periksa') }}" class="small-box-footer">
          Daftar Sekarang <i class="fas fa-arrow-circle-right"></i>
        </a>
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
    // Hapus kode yang tidak diperlukan
    });
  </script>
@endpush