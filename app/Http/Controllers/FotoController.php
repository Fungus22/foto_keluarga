<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// mengkoneksikan antara controller dan model
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;
// cok menghubungkan antara storage 
class FotoController extends Controller
{

    public function index()
    {
        $foto = Foto::all();
        $data = [
            "foto"  =>  $foto
        ];
        return view("foto.index", $data);
    }

    public function create()
    {
        $albums = Album::all();

        return view("foto.create")->with("albums", $albums);
    }

    public function store(Request $request)
    {
        $album = $request->album;
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;

        $insertFoto = new Foto();
        $insertFoto->album_id = $album;
        $insertFoto->judul = $judul;
        $insertFoto->tanggal_unggah = date("d-m-Y");
        /**
         * deskripsi opsional bisa diisi / tidak diisi
         * isi deskripsi apabila user input deskripsi
         */

         if(!empty($deskripsi)) {
            $insertFoto->deskripsi = $deskripsi;
         }
         //check apakah terdapat file yang diupload user 
         //pemanfaatan percabangan dapat kita lihat pada level  kode berikut
         if($request->hasFile("foto")) {
            //ambil input file yang bernama foto
            $foto = $request->file("foto");
            // buat nama file yang namanya unik perdetiknya
            //ambil extensi nama file yang diupload 
            $namaFotoBaru = date("Y_m_d_H_i_s"). "." . $foto->getClientOriginalExtension();
            //upload file kedalam folder foto % rename file yang sudah diupload
            $foto->storeAs("/foto", $namaFotoBaru, "public");
            //masukan nama file kedalam field lokasi_file pada table foto
            $insertFoto->lokasi_file = "foto/{$namaFotoBaru}";
         }
         $insertFoto->save();

         return redirect()->route("foto.index");
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $albums = Album::all();

        $foto = Foto::where("id", "=", $id)->first();

        $data = [
            "albums" => $albums,
            "foto" => $foto
        ];

        return view("foto.edit", $data);
    }

    public function update(Request $request, string $id)
    {
        $album = $request->album;
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;

        $updateFoto = [
            "album_id" => $album,
            "judul" => $judul,
        ];
        /**
         * deskripsi opsional bisa diisi bisa tidak diisi
         * isi deskripsi apabila user input deskripsi
         */
        if(!empty($deskripsi)) {
            $updateFoto["deskripsi"] = $deskripsi;
        }

        // check apakah terdapat file yang diupload oleh user ?
        // pemanfaatan pencabangan daapat kita lihat dari level kode brkut
        if($request->hasFile("foto")) {
            // ambil input file yang bernama foto
            $foto = $request->file("foto");
            //chech apakah benar foto tersebut diisi dan bukan file corup
            if($foto->isValid()) {
                // dapat dilihat pemanfaatan method deleteFileFoto 
                // salah satu manfaat anda menggunakan konsep OOP :
                //kita hanya membuat 1 method tetapi dapat dimanfaatkan berulang kali
                $this->deleteFileFoto($id); //delete file yang lama apabila terdapat fiel yang baru
                // membuat nama file yang benar benar unik perdetik nya
                // ambil extens nama file yang diupload
                $namaFotoBaru = date("Y_m_d_H_i_s") . "." . $foto->getClientOriginalExtension();
                //upload file kedalam folder foto & rename file yang sudah diupload
                $foto->storeAs("/foto", $namaFotoBaru, "public");
                //masukan nama file kedalam field lokasi_file pada table foto
                $updateFoto["lokasi_file"]="foto/{$namaFotoBaru}";
            }
        }

        Foto::where("id", "=", $id)->update($updateFoto);

        return redirect()->route("foto.index");
    }

    private function deleteFileFoto(string $id) {
        $foto = Foto::where("id", $id)->first();
        //check apakah ada file data folder storage
        if (Storage::disk("public")->exists($foto->lokasi_file)) {
            // apabila file ditemukan maka hapus foto sabelum hpus data pada tabel
            Storage::disk("public")->delete($foto->lokasi_file);
        }
    }

    public function destroy(string $id)
    {
        $foto = Foto::where("id", $id)->first();

        // panggil fungsi delete file foto
        $this->deleteFileFoto($id);

        $foto->delete();

        return redirect()->route("foto.index");
    }
}
