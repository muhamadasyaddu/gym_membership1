<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresensiRequest extends FormRequest
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
            'transaksi_id' => 'required|exists:transaksi,id',
            'waktu_masuk' => 'nullable|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'transaksi_id.required' => 'Transaksi wajib dipilih.',
            'transaksi_id.exists' => 'Transaksi tidak ditemukan.',
            'waktu_masuk.date' => 'Format waktu tidak valid.',
        ];
    }
}