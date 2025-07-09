<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataHasilQcRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal'           => ['required', 'date'],
            'nama_produk'       => ['required', 'exists:master_produk,id'],
            'jenis_bahan'       => ['required', 'string'],
            'tebal_bahan'       => ['required', 'numeric'],
            'nama_mesin'        => ['required', 'string'],
            'jumlah_cavity'     => ['required', 'numeric'],
            'status_pre'        => ['required', 'in:OK,NO'],
            'dimensi_panjang'   => ['required', 'numeric'],
            'dimensi_lebar'     => ['required', 'numeric'],
            'dimensi_tinggi'    => ['required', 'numeric'],
            'aql_check'         => ['required', 'string'],
            'inline'            => ['required', 'in:Thermolid,Vacuum,Sortir Atas'],
            'point_critical'    => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'numeric'  => ':attribute harus berupa angka.',
            'date'     => ':attribute harus berupa tanggal yang valid.',
            'in'       => ':attribute tidak valid.',
            'exists'   => ':attribute tidak ditemukan.',
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal'           => 'Tanggal',
            'nama_produk'       => 'Nama Produk',
            'jenis_bahan'       => 'Jenis Bahan',
            'tebal_bahan'       => 'Tebal Bahan',
            'nama_mesin'        => 'Nama Mesin',
            'jumlah_cavity'     => 'Jumlah Cavity',
            'status_pre'        => 'Status Pre',
            'dimensi_panjang'   => 'Dimensi Panjang',
            'dimensi_lebar'     => 'Dimensi Lebar',
            'dimensi_tinggi'    => 'Dimensi Tinggi',
            'aql_check'         => 'AQL Check',
            'inline'            => 'Inline',
            'point_critical'    => 'Point Critical',
        ];
    }
}
