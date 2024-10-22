@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Tambah</strong> Satuan</h1>

            <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_satuan">Nama Satuan</label>
                    <input type="text" name="nama_satuan" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="status" value="1"> <!-- Status otomatis 1 -->
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </main>
@endsection
