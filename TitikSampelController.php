<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TitikSampel;

class TitikSampelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nama = "Titik Sampel";
        $titiksampel = TitikSampel::all();
        // $titiksampel = DB::table('titik_sampels')->get();
        return view('titiksampel.index', compact('titiksampel'))
            ->with('nama', $nama);
    }

    /**
     *  Show the form for creating a new resource.
     */
    public function create()
    {
        return view('titiksampel.add');
    }

    /**
     *  Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new TitikSampel();
        $data->nama = $request->nama;
        $data->longitude = $request->longitude;
        $data->latitude = $request->latitude;
        $data->save();

        return redirect()->route('titiksampel.index');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {
        //https://laravel.com/docs/10.x/eloquent
        $titiksampel = TitikSampel::find($id);
        return view('titiksampel.edit', compact('titiksampel'));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $data = TitikSampel::find($id);
        $data->nama = $request->nama;
        $data->longitude = $request->longitude;
        $data->latitude = $request->latitude;
        $data->save();

    return redirect()->route('titiksampel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TitikSampel::destroy($id);
        return redirect()->route('titiksampel.index');
    }

}