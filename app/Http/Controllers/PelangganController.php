<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{

    public function create(Request $request) {

        $validation = Validator::make($request->all(), [
            'nik' => 'required|max:16',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required|max:12',
            'jenkel' => 'required|max:1',
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $result = \App\Pelanggan::create($request->all());

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
        $result = \App\Pelanggan::all();
        return [
            'status' => 'sukses',
            'message' => 'Data berhasil didapatkan',
            'result' => $result
        ];
    }

    public function update(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            'nik' => 'required|max:16',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required|max:12',
            'jenkel' => 'required|max:1',
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $pelanggan = \App\Pelanggan::find($id);
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
        $pelanggan = \App\Pelanggan::find($id);
        if(empty($pelanggan)) {
            return [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'result' => null
            ];
        }

        $result = $pelanggan->delete($id);
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
