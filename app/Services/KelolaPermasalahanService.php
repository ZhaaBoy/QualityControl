<?php

namespace App\Services;

use App\Http\Requests\KelolaPermasalahanRequest;
use App\Models\KelolaPermasalahan;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;

class KelolaPermasalahanService
{
    use FileTrait;
    public function saveData(KelolaPermasalahanRequest $request, KelolaPermasalahan $kelolaPermasalahan): array
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                $data['foto'] = $this->storeFile('kelola_permasalahan/foto', $request->file('foto'));
            }
            if ($kelolaPermasalahan->id) {
                $this->deleteFile('kelola_permasalahan/foto', $kelolaPermasalahan->foto, $request->hasFile('foto'));
                $kelolaPermasalahan->update($data);
            } else {
                $kelolaPermasalahan = KelolaPermasalahan::create($data);
            }
            DB::commit();
            Log::channel('log-transaction')->info(($kelolaPermasalahan->wasRecentlyCreated ? 'Data Created!' : 'Data Updated!'), ['User' => Auth::user()->name ?? 'System']
            );

            return [
                'success' => 1,
                'message' => $kelolaPermasalahan->wasRecentlyCreated ? 'Data Hasil Produk berhasil disimpan' : 'Data Hasil Produk berhasil diperbarui',
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
            $data = KelolaPermasalahan::findOrFail($id);
            if (Storage::disk('public')->exists('kelola_permasalahan/foto') && !empty($data->foto)) {
                Storage::disk('public')->delete("kelola_permasalahan/foto/{$data->foto}");
            }
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

