@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Tambah</strong> Barang</h1>

            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="idsatuan">Satuan</label>
                    <select name="idsatuan" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($satuan as $s)
                            <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="hidden" name="status" value="1"> <!-- Status otomatis 1 -->
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </main>
@endsection
