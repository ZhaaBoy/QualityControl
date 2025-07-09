<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelolaPermasalahanRequest extends FormRequest
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
        $isUpdate = $this->method() === 'PATCH' || $this->method() === 'PUT';

        return [
            'jam'           => 'required|date',
            'mesin'         => 'required|string|max:255',
            'nama_operator' => 'required|string|max:255',
            'nama_produk'   => 'required|exists:master_produk,id',
            'permasalahan'  => 'required|string|max:255',
            'inline'        => 'required|in:Thermolid,Vacuum,Sortir Atas',
            'penyebab'      => 'required|string|max:255',
            'foto'          => $isUpdate
                ? 'nullable|image|mimes:jpeg,jpg,png|max:2048'
                : 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }
}
