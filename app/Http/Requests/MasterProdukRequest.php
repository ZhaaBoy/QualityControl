<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasterProdukRequest extends FormRequest
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
            'customer'            => 'required|string|max:255',
            'kode_barang'         => 'required|string|max:255',
            'nama_produk'         => 'required|string|max:255',
            'bahan'               => 'required|string|max:255',

            'gramature_min'       => 'required|numeric|min:0',
            'gramature_standar'   => 'required|numeric|min:0',
            'gramature_max'       => 'required|numeric|min:0',

            'tebal_bahan'         => 'required|numeric|min:0',

            'dimensi_panjang'     => 'required|numeric|min:0',
            'dimensi_lebar'       => 'required|numeric|min:0',
            'dimensi_tinggi'      => 'required|numeric|min:0',
        ];
    }
}
