@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Barang</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <input type="text" name="jenis" class="form-control" value="{{ $barang->jenis }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="satuan_id" class="form-label">Satuan</label>
                        <select name="satuan_id" class="form-control" required>
                            @foreach ($satuan as $item)
                                <option value="{{ $item->satuan_id }}"
                                    {{ $item->satuan_id == $barang->satuan_id ? 'selected' : '' }}>
                                    {{ $item->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $barang->status ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$barang->status ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
