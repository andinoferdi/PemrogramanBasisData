@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Tambah Vendor</strong></h1>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('vendor.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_vendor" class="form-label">Nama Vendor</label>
                        <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
                    </div>
                    <div class="mb-3">
                        <label for="badan_hukum" class="form-label">Badan Hukum</label>
                        <input type="text" class="form-control" id="badan_hukum" name="badan_hukum" required>
                    </div>
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
