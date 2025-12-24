@extends('adminlte::page')

@section('title', 'Daftar Produk')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Manajemen Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="product-table">
            <thead>
                <tr>
                    <th style="width: 50px">ID</th>
                    <th>Game</th>
                    <th>Nama Produk</th>
                    <th>SKU</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Status</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->game->name ?? 'N/A' }}</td>
                        <td>{{ $product->name }}</td>
                        <td><code>{{ $product->sku }}</code></td>
                        <td>Rp {{ number_format($product->price_modal, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->price_sell, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#product-table').DataTable();
    });
</script>
@stop