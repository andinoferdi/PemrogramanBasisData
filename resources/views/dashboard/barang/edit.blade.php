@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Edit</strong> Barang</h1>

            <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                </div>

                <div class="form-group">
                    <label for="idsatuan">Satuan</label>
                    <select name="idsatuan" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($satuan as $s)
                            <option value="{{ $s->idsatuan }}" {{ $barang->idsatuan == $s->idsatuan ? 'selected' : '' }}>
                                {{ $s->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="hidden" name="status" value="1"> <!-- Status otomatis 1 -->
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </main>
@endsection
