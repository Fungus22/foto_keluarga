@extends('layout2')

@section('content')
<center>
    <div>
        <h1>Data Album</h1>
        <a href="{{ route('album.create') }}">Tambah Album Baru</a>
        <br>
        <br>
        <table border="2">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Album</th>
                    <th>Deskripsi Album</th>
                    <th>Tanggal Dibuat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $no=1;
                @endphp

                @forelse($album as $a)
                <tr>
                    <th>{{ $no++ }}.</th>
                    <th>{{ $a->nama_album }}</th>
                    <th>{{ $a->deskripsi }}</th>
                    <th>{{ $a->tanggal_dibuat }}</th>
                    <th>
                        <a href="{{ route('album.edit', $a->id) }}">
                            <button>Edit</button>
                        </a>
                        <form action="{{ route('album.destroy', $a->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">delete</button>
                        </form>
                    </th>
                </tr>
                @empty
                    <tr>
                        <th colspan="5">Tidak Ada Album</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</center>
@endsection