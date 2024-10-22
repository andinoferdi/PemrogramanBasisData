<!-- resources/views/dashboard/satuan/index.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Master</strong> Satuan</h1>

            <a href="{{ route('satuan.create') }}" class="btn btn-primary mb-3">Tambah Satuan</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Satuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($satuan as $item)
                        <tr>
                            <td>{{ $item->nama_satuan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ route('satuan.edit', $item->idsatuan) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('satuan.destroy', $item->idsatuan) }}" method="POST"
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
