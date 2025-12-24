@extends('adminlte::page')

@section('title', 'Edit Game')

@section('content_header')
<h1>Edit Game: {{ $game->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info">
            <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Game</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $game->name) }}" required>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="platform">Platform</label>
                        <select name="platform" class="form-control">
                            <option value="Mobile" {{ $game->platform == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                            <option value="PC" {{ $game->platform == 'PC' ? 'selected' : '' }}>PC</option>
                            <option value="Console" {{ $game->platform == 'Console' ? 'selected' : '' }}>Console</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="popularity_rank">Rank Populer (0-100)</label>
                        <input type="number" name="popularity_rank" class="form-control"
                            value="{{ old('popularity_rank', $game->popularity_rank) }}">
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail (Ganti jika ingin mengubah)</label>
                        <div class="custom-file mb-2">
                            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail"
                                onchange="previewImage('thumbnail', 'thumb-preview')">
                            <label class="custom-file-label" for="thumbnail">Pilih file...</label>
                        </div>
                        <img id="thumb-preview"
                            src="{{ Str::startsWith($game->thumbnail, 'http') ? $game->thumbnail : asset($game->thumbnail) }}"
                            class="img-fluid rounded" style="max-height: 150px;">
                    </div>

                    <div class="form-group">
                        <label for="banner">Banner (Ganti jika ingin mengubah)</label>
                        <div class="custom-file mb-2">
                            <input type="file" name="banner" class="custom-file-input" id="banner"
                                onchange="previewImage('banner', 'banner-preview')">
                            <label class="custom-file-label" for="banner">Pilih file...</label>
                        </div>
                        <img id="banner-preview"
                            src="{{ Str::startsWith($game->banner, 'http') ? $game->banner : asset($game->banner) }}"
                            class="img-fluid rounded" style="max-height: 150px;">
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {{ $game->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update Game</button>
                    <a href="{{ route('admin.games.index') }}" class="btn btn-default">Kembali</a>
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
    function previewImage(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const label = input.nextElementSibling;

        if (input.files && input.files[0]) {
            label.innerText = input.files[0].name;
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop