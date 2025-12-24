@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
<h1>Edit Produk: {{ $product->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="game_id">Pilih Game</label>
                        <select name="game_id" class="form-control select2 @error('game_id') is-invalid @enderror"
                            required>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}" {{ old('game_id', $product->game_id) == $game->id ? 'selected' : '' }}>
                                    {{ $game->name }} ({{ $game->platform }})
                                </option>
                            @endforeach
                        </select>
                        @error('game_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name) }}" required>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="sku">SKU (Kode Unik)</label>
                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                            value="{{ old('sku', $product->sku) }}" required>
                        @error('sku') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_modal">Harga Modal (Rp)</label>
                                <input type="number" name="price_modal"
                                    class="form-control @error('price_modal') is-invalid @enderror"
                                    value="{{ old('price_modal', $product->price_modal) }}" required>
                                @error('price_modal') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sell">Harga Jual (Rp)</label>
                                <input type="number" name="price_sell"
                                    class="form-control @error('price_sell') is-invalid @enderror"
                                    value="{{ old('price_sell', $product->price_sell) }}" required>
                                @error('price_sell') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
@stop