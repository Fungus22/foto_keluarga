<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
class AlbumController extends Controller
{
    public function index()
    {
        $album = Album::all();
        $data = [
            "album" => $album
        ];
        return view("album.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("album.create");
    }
    public function store(Request $request)
    {
        $namaAlbum = $request->nama_album;
        $deskripsi = $request->deskripsi;
        $tanggalDibuat = $request->tanggal_dibuat;

        $dataAlbum = new Album();
        $dataAlbum->nama_album = $namaAlbum;
        $dataAlbum->deskripsi = $deskripsi;
        $dataAlbum->tanggal_dibuat = $tanggalDibuat;
        $dataAlbum->save();

        return redirect()->route("album.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $album = Album::where("id", $id)->first();
        $data = [
            "album" => $album
        ];

        return view("album.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = $request->id;
        $namaAlbum = $request->nama_album;
        $deskripsi = $request->deskripsi;
        $tanggalDibuat = $request->tanggal_dibuat;

        $dataAlbum = Album::where("id", $id)->first();
        $dataAlbum->id = $id;
        $dataAlbum->nama_album = $namaAlbum;
        $dataAlbum->deskripsi = $deskripsi;
        $dataAlbum->tanggal_dibuat = $tanggalDibuat;
        $dataAlbum->save();

        return redirect()->route("album.index");
    }

    public function destroy(string $id)
    {
        $album = Album::where("id", $id)->first();

        $album->delete();

        return redirect()->route("album.index");
    }
}
