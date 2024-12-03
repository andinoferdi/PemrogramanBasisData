@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Detail Penjualan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detail_penjualan.update', $detailPenjualan->detail_penjualan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}"
                                    {{ $detailPenjualan->barang_id == $item->barang_id ? 'selected' : '' }}>
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
                            value="{{ $detailPenjualan->harga_satuan }}" autocomplete="off" required>
                        @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ $detailPenjualan->jumlah }}" autocomplete="off" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penjualan_id" class="form-label">Penjualan ID</label>
                        <select name="penjualan_id" class="form-control @error('penjualan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled>Pilih Penjualan</option>
                            @foreach ($penjualan as $item)
                                <option value="{{ $item->penjualan_id }}"
                                    {{ $detailPenjualan->penjualan_id == $item->penjualan_id ? 'selected' : '' }}>
                                    {{ $item->penjualan_id }} - {{ $item->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('penjualan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
