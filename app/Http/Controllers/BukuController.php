<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Bukudetail;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.databuku', [
            'title' => 'Data Buku',
            'bukus' => Buku::all(),
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|min:3',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            // 'cover' => 'image|file|max:1024',
        ]);
        $validatedData['cover'] = ($request->image) ? $request->image: 'https://cdn3d.iconscout.com/3d/premium/thumb/book-5596349-4665465.png';

        $buku = Buku::create($validatedData);

        $validatedDetail = [
            'buku_id' => $buku->id,
            'availability' => 'available',
        ];

        // Mengambil nilai stok dari permintaan
        $stok = $request->input('   stok');

        // Membuat detail buku sesuai dengan jumlah stok yang diberikan
        for ($i = 1; $i <= $stok; $i++) {
            Bukudetail::create($validatedDetail);
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku, $id)
    {
        // $param = str_replace('http://127.0.0.1:8000/databuku/', '', url()->current());
        // // $buku = Buku::findOrfail($id);
        // return view('page.detailbuku',[
        //     'buku' => Buku::where('id', $param)->first(),
        //     'bukudetails' => Bukudetail::where('buku_id', $param)->get(),
        //     // 'kategoris' => Kategori::all()
        // ]);
        $buku = Buku::findOrFail($id);
        return view('page.detailbuku', [
            'buku' => $buku,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {

        $buku = Buku::findOrFail($request->buku_id);

        $validatedData = $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required|min:3',
            'penulis' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
        ]);

        $validated['cover'] = ($request->image) ? $request->image : 'https://cdn3d.iconscout.com/3d/premium/thumb/book-5596349-4665465.png';

        // Perbarui atribut buku
        $buku->update($validatedData);

        // Perbarui detail buku
        $bookStock = Bukudetail::where('buku_id', $buku->id)->count();
        $stok = $request->input('stok');

        // Jika stok baru lebih besar dari stok sebelumnya, tambahkan detail buku baru
        if ($stok > $bookStock) {
            $detailToAdd = $stok - $bookStock;
            for ($i = 0; $i < $detailToAdd; $i++) {
                Bukudetail::create([
                    'buku_id' => $buku->id,
                    'availability' => 'available',
                ]);
            }
        }
        // Jika stok baru lebih kecil dari stok sebelumnya, hapus detail buku yang berlebihan
        elseif ($stok < $bookStock) {
            $detailToDelete = $bookStock - $stok;
            Bukudetail::where('buku_id', $buku->id)->take($detailToDelete)->delete();
            }

        return redirect()->back()->with('success', 'Buku berhasil di Update');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);
        $buku = Buku::where('id', $request['buku_id']);
        $buku->delete();
        return redirect('/databuku')->with('success', 'buku berhasil dihapus');
    }
}
