@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Tambah</strong> Satuan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('satuan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_satuan" class="form-label">Nama Satuan</label>
                        <input type="text" name="nama_satuan" class="form-control" required>
                    </div>

                    <input type="hidden" name="status" value="1">

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
