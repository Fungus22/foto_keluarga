@extends('layout2')
@section('content')
<center>
    <div>
        <h1>Edit data Album</h1>
        <a href="{{ route('album.index') }}">Tidak Jadi Edit / Kembali keMenu awal</a>
        <br>
        <br>
        <form action="{{ route('album.update', $album->id) }}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="nama_album">Nama Album</label>
                <input type="hidden" value="{{ $album->id }}" name="id" id="id">
                <input type="text" id="nama_album" name="nama_album" value="{{ $album->nama_album }}" required>
            </div>
            <div>
                <label for="deskripsi">deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" type="text">{{ $album->deskripsi }}</textarea>
            </div>
            <div>
                <label for="tanggal_dibuat">Tanggal Album dibuat</label>
                <input type="date" id="tanggal_dibuat" name="tanggal_dibuat" value="{{ $album->tanggal_dibuat }}" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</center>
@endsection