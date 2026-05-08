<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlatGymRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'merek' => 'nullable|string|max:255',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'waktu_pembelian' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama alat wajib diisi.',
            'nama.max' => 'Nama alat maksimal 255 karakter.',
            'merek.max' => 'Merek maksimal 255 karakter.',
            'kondisi.required' => 'Kondisi wajib dipilih.',
            'kondisi.in' => 'Kondisi tidak valid.',
            'waktu_pembelian.date' => 'Format tanggal tidak valid.',
        ];
    }
}