@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Detail Pengadaan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('detailPengadaan.create') }}" class="btn btn-primary">Tambah Detail Pengadaan</a>
                </div>
            </div>

            <div class="card-body pt-0">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengadaan ID</th>
                            <th>Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailPengadaan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pengadaan_id }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->harga_satuan }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->subtotal }}</td>
                                <td>
                                    <a href="{{ route('detailPengadaan.edit', $item->detail_pengadaan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('detailPengadaan.destroy', $item->detail_pengadaan_id) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
