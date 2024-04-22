<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use App\Models\Bukudetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.datapeminjaman',[
            'peminjamen' => Peminjaman::where('history', null)->get(),
            'bukus' => Buku::all(),
            'members' => User::where('role','member')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required',
            'buku_id' => 'required',
        ]);

        $validatedData['admin_id'] = Auth()->user()->id;

        $bukudetail_id = Bukudetail::where('buku_id', $request['buku_id'])->where('availability', 'available')->first()->id;

        $validatedData['bukudetail_id'] = $bukudetail_id;


        Peminjaman::create($validatedData);

        Bukudetail::where('buku_id', $request['buku_id'])->where('availability', 'available')->first()->update(['availability' => 'unavailable']);

        return redirect('/datapeminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {

        $validatedData = $request->validate([
            'buku_id' => 'required',
            'peminjaman_id' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $bukudetail = Bukudetail::where('buku_id', $request['buku_id'])->where('availability', 'unavailable')->first();

        $validatedData['bukudetail_id'] = $bukudetail;

        $bukudetail->where('buku_id', $request['buku_id'])->where('availability', 'unavailable')->first()->update(['availability' => 'available']);
        $peminjaman->update([
            'history' => 1,
            'tgl_kembali' => now()
        ]);

        return redirect('/datapeminjaman');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }

    public function history()
    {
        $user = (auth()->user()->role == "member") ? 'member' : '';

        if($user) {
            $data = Peminjaman::where('user_id', auth()->user()->id)
                                ->orderBy('id', 'desc')
                                ->get();
        }
        else {
            $data = Peminjaman::all();
        }

        return view('page.datalaporan',[
            'data' => $data
        ]);
    }

    public function generatePDF()
    {
        // Ambil semua data peminjaman
        $peminjaman = Peminjaman::all();

        $data = [
            'peminjaman' => $peminjaman,
        ];
        $pdf = PDF::loadView('page.pdf',$data);

        return $pdf->download('laporan_peminjaman.pdf');
    }
}
