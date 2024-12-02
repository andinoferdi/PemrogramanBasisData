@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Pengadaan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('pengadaan.update', $pengadaan->pengadaan_id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ $user->user_id == $pengadaan->user_id ? 'selected' : '' }}>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select name="vendor_id" class="form-select @error('vendor_id') is-invalid @enderror" required>
                            @foreach ($vendor as $v)
                                <option value="{{ $v->vendor_id }}"
                                    {{ $v->vendor_id == $pengadaan->vendor_id ? 'selected' : '' }}>
                                    {{ $v->nama_vendor }}
                                </option>
                            @endforeach
                        </select>
                        @error('vendor_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtotal_nilai" class="form-label">Subtotal Nilai</label>
                        <input type="number" name="subtotal_nilai"
                            class="form-control @error('subtotal_nilai') is-invalid @enderror"
                            value="{{ $pengadaan->subtotal_nilai }}" required>
                        @error('subtotal_nilai')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ppn" class="form-label">PPN (%)</label>
                        <input type="number" name="ppn" class="form-control @error('ppn') is-invalid @enderror"
                            value="{{ $pengadaan->ppn }}" placeholder="Masukkan persentase PPN (contoh: 10)" required>
                        @error('ppn')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (auth()->user()->role_id == '1')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pengadaan</label>
                            <select name="status" class="form-select" required>
                                <option value="0" {{ $pengadaan->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $pengadaan->status == 1 ? 'selected' : '' }}>Sukses</option>
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
