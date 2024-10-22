@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Master</strong> Barang</h1>

            <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->satuan->nama_satuan ?? 'Tidak ada satuan' }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $item->idbarang) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('barang.destroy', $item->idbarang) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
