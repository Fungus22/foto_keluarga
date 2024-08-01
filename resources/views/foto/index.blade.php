@extends('layout')

@section('content')
<div>
    <h3>Foto Keluarga</h3>
    <a href="{{ route('foto.tambah') }}">Tambah Foto</a>
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
                $no=1
            @endphp
            <!-- $foto diambil dari FotoController -->
            @forelse($foto as $f)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $f->album->nama_album }}</td>
                <td>{{ $f->judul }}</td>
                <td>{{ $f->deskripsi }}</td>
                <td>{{ date("d-m-Y", strtotime($foto->tanggal_unggah)) }}</td>
                <td><img src="{{ asset("storage/{$foto->lokasi_file}") }}" alt="{{ $foto->judul }}" width="40%" /></td>
                <td>
                    <a href="{{ route('foto.edit', $foto->id) }}">
                        <button>Edit</button>
                    </a>

                    <form action="{{ route('foto.destroy', $foto->id) }}">
                        @method('delete')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Tidak terdapat data Foto!!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection