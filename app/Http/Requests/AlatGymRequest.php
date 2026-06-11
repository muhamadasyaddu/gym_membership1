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
            'nama' => 'required|string|min:3|max:255',
            'merek' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'waktu_pembelian' => 'nullable|date|before_or_equal:today',
            'terakhir_diperiksa' => 'nullable|date|before_or_equal:today',
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
            'nama.min' => 'Nama alat minimal 3 karakter.',
            'nama.max' => 'Nama alat maksimal 255 karakter.',

            'merek.max' => 'Merek maksimal 255 karakter.',

            'kondisi.required' => 'Kondisi wajib dipilih.',
            'kondisi.in' => 'Kondisi tidak valid.',

            'waktu_pembelian.date' => 'Format tanggal tidak valid.',
            'waktu_pembelian.before_or_equal'
                => 'Tanggal pembelian tidak boleh melebihi hari ini.',

            'terakhir_diperiksa.before_or_equal' => 'Tanggal pemeriksaan tidak boleh melebihi hari ini.',
        ];
    }
}