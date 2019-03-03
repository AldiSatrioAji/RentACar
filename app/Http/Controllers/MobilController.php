<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MobilController extends Controller
{

    public function create(Request $request) {

        $validation = Validator::make($request->all(), [
            'no_stnk' => 'required|string',
            'merk' => 'required|string',
            'jenis' => 'required|string',
            'warna' => 'required|string',
            'tahun_buat' => 'required|date',
            'tarif_perhari' => 'required|integer',
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $result = \App\Mobil::create($request->all());

        if($result) {
            return [
                'status' => 'sukses',
                'messaage' => 'Data berhasil ditambahkan',
                'result' => $result
            ];
        } else {
            return [
                'status' => 'gagal',
                'messaage' => 'Data gagal ditambahkan',
                'result' => null
            ];
        }
    }

    public function read(Request $request) {
        $result = \App\Mobil::all();
        return [
            'status' => 'sukses',
            'message' => 'Data berhasil didapatkan',
            'result' => $result
        ];
    }

    public function update(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            'no_stnk' => 'required|string',
            'merk' => 'required|string',
            'jenis' => 'required|string',
            'warna' => 'required|string',
            'tahun_buat' => 'required|date',
            'tarif_perhari' => 'required|integer',
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $pelanggan = \App\Mobil::find($id);
        if(empty($pelanggan)) {
            return [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'result' => null
            ];
        }

        $result = $pelanggan->update($request->all());

        if($result) {
            return [
                'status' => 'sukses',
                'message' => 'Data berhasil diubah',
                'result' => $result
            ];
        } else {
            return [
                'status' => 'gagal',
                'message' => 'Data gagal diubah',
                'result' => null
            ];
        }
    }

    public function delete(Request $request, $id) {
        $mobil = \App\Mobil::find($id);
        if(empty($mobil)) {
            return [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'result' => null
            ];
        }

        $result = $mobil->delete($id);
        if($result) {
            return [
                'status' => 'sukses',
                'message' => 'Data berhasil dihapus',
                'result' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Data gagal dihapus',
                'result' => null
            ];
        }

    }

}
