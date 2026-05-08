<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketGymRequest extends FormRequest
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
            'nama_paket' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_paket.required' => 'Nama paket wajib diisi.',
            'nama_paket.max' => 'Nama paket maksimal 255 karakter.',
            'durasi_hari.required' => 'Durasi wajib diisi.',
            'durasi_hari.integer' => 'Durasi harus berupa angka.',
            'durasi_hari.min' => 'Durasi minimal 1 hari.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}