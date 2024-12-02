@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Detail Pengadaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detail_pengadaan.update', $detailPengadaan->detail_pengadaan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}"
                                    {{ $detailPengadaan->barang_id == $item->barang_id ? 'selected' : '' }}>
                                    {{ $item->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="number" name="harga_satuan"
                            class="form-control @error('harga_satuan') is-invalid @enderror"
                            value="{{ $detailPengadaan->harga_satuan }}" autocomplete="off" required>
                        @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ $detailPengadaan->jumlah }}" autocomplete="off" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pengadaan_id" class="form-label">Pengadaan ID</label>
                        <select name="pengadaan_id" class="form-control @error('pengadaan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled>Pilih Pengadaan</option>
                            @foreach ($pengadaan as $pengadaan)
                                <option value="{{ $pengadaan->pengadaan_id }}"
                                    {{ $detailPengadaan->pengadaan_id == $pengadaan->pengadaan_id ? 'selected' : '' }}>
                                    {{ $pengadaan->pengadaan_id }} - {{ $pengadaan->nama_vendor }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengadaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
