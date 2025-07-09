<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataHasilProduksiRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'mesin' => 'required|string|max:255',
            'nama_produk' => 'required|exists:master_produk,id',
            'jenis_bahan' => 'required|string|max:255',
            'acuan_sampling' => 'required|string|max:255',
            'aql_check' => 'required|string|max:255',
            'status_pre_order' => 'required|in:Open,Close',
            'tanggal_start_awal' => 'required|date',
        ];
    }
}
