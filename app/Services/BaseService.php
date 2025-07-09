<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BaseService
{
    public function saveData($request, $model, $inserts, $rules): array
    {
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return [
                'success' => 0,
                'message' => $validator->errors()->first(),
                'status_code' => 422
            ];
        }

        try {
            $data_model = $model;
            foreach ($inserts as $key => $value) {
                $data_model[$key] = $value;
            }   
            $data_model->save();

            Log::channel('log-transaction')->info(($data_model->wasRecentlyCreated ? 'Data Created!' : 'Data Updated!'),
                ['User' => Auth::user()->name ?? 'System']
            );

            return [
                'success' => 1,
                'data' => $data_model,
                'message' => $data_model->wasRecentlyCreated ? 'Data berhasil disimpan' : 'Data berhasil diperbarui',
                'status_code' => 200
            ];
        } catch (\Exception $e) {
            Log::channel('log-transaction')->info($e->getMessage(), ['User' =>  Auth::user()->name]);
            return [
                'success' => 0,
                'message' => $e->getMessage(),
                'status_code' => 500
            ];
        }
    }

    public function delete($model): array
    {
        try {
            $data = $model;
            $data->delete();

            Log::channel('log-transaction')->info('Data Deleted!', [
                'User' => Auth::user()->name ?? 'System',
            ]);

            return [
                'success' => 1,
                'message' => 'Data Berhasil Dihapus',
                'status_code' => 200
            ];
        } catch (\Throwable $e) {
        Log::channel('log-transaction')->error('Error deleting Data', [
                'User' => Auth::user()->name ?? 'System',
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
