@extends('adminlte::page')

@section('title', 'Tambah Game')

@section('content_header')
<h1>Tambah Game Baru</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Game</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Contoh: Mobile Legends" value="{{ old('name') }}" required>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="platform">Platform</label>
                        <select name="platform" class="form-control">
                            <option value="Mobile">Mobile</option>
                            <option value="PC">PC</option>
                            <option value="Console">Console</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="popularity_rank">Rank Populer (0-100)</label>
                        <input type="number" name="popularity_rank" class="form-control"
                            value="{{ old('popularity_rank', 0) }}">
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail (Foto Kotak)</label>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail"
                                onchange="previewImage('thumbnail', 'thumb-preview')">
                            <label class="custom-file-label" for="thumbnail">Pilih file...</label>
                        </div>
                        <img id="thumb-preview" class="img-fluid mt-2 rounded" style="max-height: 150px; display:none;">
                    </div>

                    <div class="form-group">
                        <label for="banner">Banner (Foto Lebar)</label>
                        <div class="custom-file">
                            <input type="file" name="banner" class="custom-file-input" id="banner"
                                onchange="previewImage('banner', 'banner-preview')">
                            <label class="custom-file-label" for="banner">Pilih file...</label>
                        </div>
                        <img id="banner-preview" class="img-fluid mt-2 rounded"
                            style="max-height: 150px; display:none;">
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" checked>
                            <label class="custom-control-label" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Game</button>
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
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop