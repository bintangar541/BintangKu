@extends('adminlte::page')

@section('title', 'Daftar Game')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Manajemen Game</h1>
    <a href="{{ route('admin.games.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Game
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
        <table class="table table-bordered table-striped" id="game-table">
            <thead>
                <tr>
                    <th style="width: 50px">ID</th>
                    <th style="width: 80px">Foto</th>
                    <th>Nama Game</th>
                    <th>Platform</th>
                    <th>Rank Populer</th>
                    <th>Status</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                    <tr>
                        <td>{{ $game->id }}</td>
                        <td>
                            <img src="{{ Str::startsWith($game->thumbnail, 'http') ? $game->thumbnail : asset($game->thumbnail) }}"
                                alt="{{ $game->name }}" class="img-thumbnail" style="width: 50px;">
                        </td>
                        <td>{{ $game->name }}</td>
                        <td>{{ $game->platform ?? '-' }}</td>
                        <td>{{ $game->popularity_rank }}</td>
                        <td>
                            <span class="badge badge-{{ $game->is_active ? 'success' : 'danger' }}">
                                {{ $game->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus game ini?')">
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
        $('#game-table').DataTable();
    });
</script>
@stop