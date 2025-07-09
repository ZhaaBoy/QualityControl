<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LaporanHasilProduksiRequest extends FormRequest
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
            'nama_operator' => 'required|string|max:255',
            'nama_produk' => 'required|exists:master_produk,id',
            'acuan_sampling' => 'required|string|max:255',
            'aql_check' => 'required|string|max:255',
            'status_produk' => 'required|in:OK,HOLD,NG',
            'temuan_defect' => 'nullable|string|max:255',
        ];
    }
}
