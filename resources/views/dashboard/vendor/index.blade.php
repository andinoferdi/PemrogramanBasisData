@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Vendor</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('vendor.create') }}" class="btn btn-primary">Tambah Vendor</a>
                </div>
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
                            <th>Nama Vendor</th>
                            <th>Badan Hukum</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendor as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_vendor }}</td>
                                <td>{{ $item->badan_hukum == 'P' ? 'PT' : 'CV' }}</td>
                                <td>{{ $item->status == 'A' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <a href="{{ route('vendor.edit', $item->vendor_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('vendor.delete', $item->vendor_id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data vendor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
