@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Edit</strong> Satuan</h1>

            <form action="{{ route('satuan.update', $satuan->idsatuan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_satuan">Nama Satuan</label>
                    <input type="text" name="nama_satuan" class="form-control" value="{{ $satuan->nama_satuan }}" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="status" value="1"> <!-- Status otomatis 1 -->
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </main>
@endsection
