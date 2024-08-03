@extends('layout')

@section('content')
<center>
<div>
    <h1>Foto Keluarga</h1>
    <!-- revisi dri foto.tambah jadi foto.create || agar lebih memahami pengunaan Route::resource -->
    <a href="{{ route('foto.create') }}">Tambah Foto</a>
    <br>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>NO</th>
                <th>Album</th>
                <th>Judul</th>
                <th>Deskripsi Foto</th>
                <th>Tanggal diUnggah</th>
                <th>Foto</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            <!-- $foto diambil dari FotoController -->
            @forelse($foto as $f)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $f->album->nama_album }}</td>
                    <td>{{ $f->judul }}</td>
                    <td>{{ $f->deskripsi }}</td>
                    <td>{{ date("d-m-Y", strtotime($f->tanggal_unggah)) }}</td>
                    <td><img src="{{ asset("storage/{$f->lokasi_file}") }}" alt="{{ $f->judul }}" width="23%" /></td>
                    <td>
                        <a href="{{ route('foto.edit', $f->id) }}">
                            <button>Edit</button>
                        </a>
                        <form action="{{ route('foto.destroy', $f->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak terdapat data Foto!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</center>
@endsection