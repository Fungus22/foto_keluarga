@extends('layout2')

@section('content')
<center>
    <div>
        <h1>Tambah Album</h1>
        <a href="{{ route('album.index') }}">Kembali ke Menu awal</a>
        <br>
        <br>
        <form action="{{ route('album.store') }}" method="post">
            @csrf
            <div>
                <label for="nama_album">Nama Album</label>
                <input type="text" id="nama_album" name="nama_album" placeholder="Masukan Nama Album" required>
            </div>
            <div>
                <label for="deskrisi">Deskripsi Album</label>
                <textarea type="text" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi album" required></textarea>
            </div>
            <div>
                <label for="tanggal_dibuat">Tanggal Album diBuat</label>
                <input type="date" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="Masukan Tanggal Album Dibuat" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</center>
@endsection