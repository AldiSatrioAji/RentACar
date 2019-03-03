<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SewaController extends Controller
{

    public function create(Request $request) {

        $validation = Validator::make($request->all(), [
            'nik' => 'required|string',
            'id_admin' => 'required|integer',
            'no_stnk' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'total_tarif' => 'required|integer'
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $result = \App\Sewa::create($request->all());

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
        $result = \App\Sewa::all();
        return [
            'status' => 'sukses',
            'message' => 'Data berhasil didapatkan',
            'result' => $result
        ];
    }

    public function update(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            'nik' => 'required|string',
            'id_admin' => 'required|integer',
            'no_stnk' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'total_tarif' => 'required|integer'
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return [
                'status' => 'error',
                'message' => $errors,
                'result' => null
            ];
        }

        $pelanggan = \App\Sewa::find($id);
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
        $Sewa = \App\Sewa::find($id);
        if(empty($Sewa)) {
            return [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'result' => null
            ];
        }

        $result = $Sewa->delete($id);
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
