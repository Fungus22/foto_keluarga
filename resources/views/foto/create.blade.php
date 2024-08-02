@extends('layout')

@section('content')
<center>
<div>
    <h1>Foto</h1>
    <a href="{{ route('foto.index') }}">Kembali ke Menu awal</a>
    <br>
    <br>
    <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="album">Album</label>
            <select name="album" id="album" required="required">
                <option value="">Pilih Album</option>
                @foreach($albums as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_album }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" placeholder="Judul Foto" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Foto"></textarea>
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
        </div>
        <div>
            <button type="submit">submit</button>
        </div>
    </form>
</div>
</center>
@endsection