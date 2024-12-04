@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Penerimaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('penerimaan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pengadaan_id" class="form-label">Pengadaan ID</label>
                        <select name="pengadaan_id" class="form-control @error('pengadaan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih Pengadaan</option>
                            @foreach ($pengadaan as $item)
                                <option value="{{ $item->pengadaan_id }}"
                                    {{ old('pengadaan_id') == $item->pengadaan_id ? 'selected' : '' }}>
                                    Pengadaan ID: {{ $item->pengadaan_id }} - {{ $item->nama_vendor }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengadaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
