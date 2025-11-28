<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['gender'];

        $searchableColumns = ['first_name','last_name','email']; //sesuai kolom Pelanggan

        // Gunakan scope filter untuk memperoses query
        $data ['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
        ->search($request, $searchableColumns)
        ->paginate(10)
        ->onEachSide(2);

        // $data['dataPelanggan'] = Pelanggan::simplepaginate(10);
        return view('admin.pelanggan.index', $data);

    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        // dd($request->all()); //untuk debug, apakah form sudah masuk
        $data['first_name'] = $request->first_name ;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        // dd($data);

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');

    }

    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $data['dataPelanggan'] = Pelanggan::findOrFail($id);
    return view('admin.pelanggan.edit', $data);
}


    public function update(Request $request, string $id)
    {
        $pelanggan_id =$id;
        $pelanggan = Pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name = $request->last_name;
        $pelanggan->birthday= $request->birthday;
        $pelanggan->gender = $request->gender;
        $pelanggan->email = $request->email;
        $pelanggan->phone = $request->phone;

        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Perubahaan Data Berhasil');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
