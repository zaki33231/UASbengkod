@extends('layout.main')
@section('title', 'Edit Pemeriksaan')

@section('isi')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Pemeriksaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa') }}">Daftar Periksa</a></li>
                            <li class="breadcrumb-item active">Edit Pemeriksaan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemeriksaan Pasien</h3>
                    </div>
                    <form action="{{ route('dokter.memeriksa.update', $periksa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" class="form-control" id="nama_pasien" value="{{ $periksa->pasien->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" 
                                            value="{{ old('tgl_periksa', $periksa->tgl_periksa ?? date('Y-m-d')) }}" required>
                                        @error('tgl_periksa')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan Pemeriksaan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="4" required>{{ old('catatan', $periksa->catatan) }}</textarea>
                                @error('catatan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Pemeriksaan</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Menunggu" {{ (old('status', $periksa->status) == 'Menunggu') ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Dalam Proses" {{ (old('status', $periksa->status) == 'Dalam Proses') ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="Selesai" {{ (old('status', $periksa->status) == 'Selesai') ? 'selected' : '' }}>Selesai</option>
                                    <option value="Batal" {{ (old('status', $periksa->status) == 'Batal') ? 'selected' : '' }}>Batal</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Obat yang Diberikan</label>
                                <div class="row">
                                    @foreach($obats as $obat)
                                        <div class="col-md-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" 
                                                    id="obat_{{ $obat->id }}" 
                                                    name="obat_id[]" 
                                                    value="{{ $obat->id }}"
                                                    data-harga="{{ $obat->harga }}"
                                                    {{ in_array($obat->id, $periksa->detailPeriksa->pluck('id_obat')->toArray()) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="obat_{{ $obat->id }}">
                                                    {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('obat_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                        <label>Total Biaya Pemeriksaan</label>
                        <input type="text" id="total_biaya" class="form-control" 
                            value="Rp{{ number_format($periksa->biaya_pemeriksaan ?? 150000, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Total Harga Obat</label>
                        <input type="text" id="total_harga_obat" class="form-control" value="Rp0" readonly>
                    </div>

                    <div class="form-group">
                        <label>Total Keseluruhan</label>
                        <input type="text" id="total_keseluruhan" class="form-control" value="Rp0" readonly>
                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('dokter.memeriksa') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="obat_id[]"]');
        const totalHargaObatInput = document.getElementById('total_harga_obat');
        const totalBiayaInput = document.getElementById('total_biaya');
        const totalKeseluruhanInput = document.getElementById('total_keseluruhan');

        function calculateTotalHargaObat() {
            let totalHargaObat = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const harga = parseInt(checkbox.getAttribute('data-harga'));
                    totalHargaObat += harga;
                }
            });
            totalHargaObatInput.value = 'Rp' + totalHargaObat.toLocaleString('id-ID');

            // Hitung total keseluruhan
            const totalBiaya = parseInt(totalBiayaInput.value.replace(/[^0-9]/g, '')) || 0;
            const totalKeseluruhan = totalBiaya + totalHargaObat;
            totalKeseluruhanInput.value = 'Rp' + totalKeseluruhan.toLocaleString('id-ID');
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotalHargaObat);
        });

        // Hitung total harga obat dan total keseluruhan saat halaman dimuat
        calculateTotalHargaObat();
    });
</script>
@endsection