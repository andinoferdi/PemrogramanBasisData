@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Tambah</strong> Detail Pengadaan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('detailPengadaan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="pengadaan_id" class="form-label">Pengadaan ID</label>
                        <select name="pengadaan_id" class="form-control" required>
                            @foreach ($pengadaan as $item)
                                <option value="{{ $item->pengadaan_id }}">{{ $item->pengadaan_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" class="form-control" required>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="number" name="harga_satuan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
