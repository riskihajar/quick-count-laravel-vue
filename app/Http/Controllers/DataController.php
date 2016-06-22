<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Data;

use App\Http\Requests;

class DataController extends Controller
{

    public function index()
    {
        return Data::all();
    }

    public function store()
    {
        $nama   = request('nama');
        $zakat  = request('zakat');
        $infaq  = request('infaq');
        $jumlah = (double) $zakat + (double) $infaq;
        return Data::create(compact('nama', 'zakat', 'infaq', 'jumlah'));
    }

    public function update($id)
    {
        $nama   = request('nama');
        $zakat  = request('zakat');
        $infaq  = request('infaq');
        $jumlah = (double) $zakat + (double) $infaq;

        $data = Data::find($id);
        $data->update(compact('nama', 'zakat', 'infaq', 'jumlah'));
        return $data->fresh();
    }

    public function destroy($id)
    {
        $data = Data::find($id);
        $data->delete();

        return $data;
    }
}
