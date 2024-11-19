@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Barang</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
                </div>
            </div>

            <div class="card-toolbar">
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger">{{ $message }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->nama_satuan }}</td>
                                <td>{{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('barang.edit', $item->barang_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('barang.delete', $item->barang_id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
