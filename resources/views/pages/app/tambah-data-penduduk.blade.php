@extends('layouts.app')

@section('title', 'New Data Penduduk')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Penduduk Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Penduduk</a></div>
                    <div class="breadcrumb-item">Tambah Data Penduduk</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card p-4">
                    <form action="{{ route('penduduk.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="pemetaan_ispa_id">Nama Desa</label>
                            <select class="form-control @error('pemetaan_ispa_id') is-invalid @enderror"
                                name="pemetaan_ispa_id" id="pemetaan_ispa_id" required>
                                <option value="" disabled selected>Pilih Nama Desa</option>
                                @foreach ($desa as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_desa }}</option>
                                @endforeach
                            </select>
                            @error('pemetaan_ispa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Umur</label>
                            <input type="number" class="form-control @error('umur') is-invalid @enderror" name="umur"
                                value="{{ old('umur') }}">
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Cek jika ada session message 'success'
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        // Handler ketika form di-submit
        document.querySelector('form').addEventListener('submit', function(e) {
            // Hentikan form dari submit normal
            e.preventDefault();

            // Tampilkan SwalAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan data sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi OK, lanjutkan submit form
                    e.target.submit();
                }
            });
        });
    </script>
    <!-- Page Specific JS File -->
@endpush
