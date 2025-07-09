<?php

namespace App\Services;

use App\Http\Requests\LaporanHasilProduksiRequest;
use App\Models\LaporanHasilProduksi;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LaporanHasilProduksiService
{
    public function saveData(LaporanHasilProduksiRequest $request, LaporanHasilProduksi $laporanHasilProduksi): array
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if ($laporanHasilProduksi->id) {
                $laporanHasilProduksi->update($data);
            } else {
                $laporanHasilProduksi = LaporanHasilProduksi::create($data);
            }
            DB::commit();
            Log::channel('log-transaction')->info(($laporanHasilProduksi->wasRecentlyCreated ? 'Data Created!' : 'Data Updated!'), ['User' => Auth::user()->name ?? 'System']
            );

            return [
                'success' => 1,
                'message' => $laporanHasilProduksi->wasRecentlyCreated ? 'Data Hasil Produk berhasil disimpan' : 'Data Hasil Produk berhasil diperbarui',
                'status_code' => 200
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('log-transaction')->info($e->getMessage(), ['User' =>  Auth::user()->name]);
            return [
                'success' => 0,
                'message' => $e->getMessage(),
                'status_code' => 500
            ];
        }
    }
    public function delete($id): array
    {
        try {
            $data = LaporanHasilProduksi::findOrFail($id);
            
            $data->delete();

            Log::channel('log-transaction')->info('Data Hasil Produk Deleted!', [
                'User' => Auth::user()->name ?? 'System',
                'ID' => $id
            ]);

            return [
                'success' => 1,
                'message' => 'Data Berhasil Dihapus',
                'status_code' => 200
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'success' => 0,
                'message' => 'Data tidak ditemukan',
                'status_code' => 404
            ];
        } catch (\Throwable $e) {
            Log::channel('log-transaction')->error('Error deleting Data Hasil Produk', [
                'User' => Auth::user()->name ?? 'System',
                'ID' => $id,
                'Error' => $e->getMessage()
            ]);

            return [
                'success' => 0,
                'message' => $e->getMessage(),
                'status_code' => 500
            ];
        }
    }
}

