@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Barang</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="idsatuan" class="form-label">Satuan</label>
                        <select name="idsatuan" class="form-select" required>
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuan as $s)
                                <option value="{{ $s->idsatuan }}"
                                    {{ $barang->idsatuan == $s->idsatuan ? 'selected' : '' }}>
                                    {{ $s->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="status" value="1">

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
