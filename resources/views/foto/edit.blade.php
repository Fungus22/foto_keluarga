@extends('layout')

@section('content')
<center>
    <div>
        <h1>Edit Data/Foto</h1>
        <a href="{{ route('foto.index') }}"></a>
        <br>
        <br>

        <form action="{{ route('foto.update', $foto->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div>
                <label for="album">Album</label>
                <select name="album" id="album" required="required">
                    <option value="">Pilih Album</option>
                    @foreach($albums as $a)
                        @php
                            // pemanfaatan percabangan / operator ternary
                            $selected = $a->id == $foto->album_id ? "selected" : "";
                        @endphp
                        <option value="{{ $a->id }}" {{ $selected }}>{{ $a->nama_album }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" placeholder="Judul Foto" value="{{ $foto->judul }}" required>
            </div>
            <div>
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Foto">{{ $foto->deskripsi }}</textarea>
            </div>
            <!-- Tampilkan Foto -->
             <img src="{{ asset("storage/{$foto->lokasi_file}") }}" alt="{{ $foto->judul }}" width="13%" />
             <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*">
             </div>
             <div>
                <button type="submit">Simpan</button>
             </div>
        </form>
    </div>
</center>
@endsection