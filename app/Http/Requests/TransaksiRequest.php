<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
            'anggota_id' => 'required|exists:anggota,id',
            'paket_id' => 'required|exists:paket_gym,id',
            'waktu_mulai' => 'required|date',
            'payment_method' => 'required|in:tunai,e-wallet',
            'status' => 'nullable|in:pending,lunas',
            'keterangan' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'anggota_id.exists' => 'Anggota tidak ditemukan.',
            'paket_id.required' => 'Paket gym wajib dipilih.',
            'paket_id.exists' => 'Paket gym tidak ditemukan.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_mulai.date' => 'Format waktu mulai tidak valid.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
            'status.in' => 'Status pembayaran tidak valid.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
        ];
    }
}