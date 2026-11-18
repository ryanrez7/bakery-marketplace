<?php

namespace App\Modules\Outlet\Http\Requests;

use App\Models\Bakery;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfilTokoRequest extends FormRequest
{
    // hanya pemilik toko yang boleh mengubah profil dan rekening (kasir tidak)
    public function authorize(): bool
    {
        $user = $this->user();

        return $user && $user->bakery && $user->role === User::ROLE_MITRA_OWNER;
    }

    public function rules(): array
    {
        return [
            'nama'        => ['required', 'string', 'max:100'],
            'jenis_usaha' => ['required', Rule::in(Bakery::JENIS_USAHA)],
            'deskripsi'   => ['nullable', 'string', 'max:1000'],
            'whatsapp'    => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],

            'alamat'      => ['required', 'string', 'max:255'],
            'kecamatan'   => ['required', Rule::in(Bakery::KECAMATAN)],

            // batas kasar wilayah Kabupaten Banyuwangi, untuk menangkap salah ketik
            'latitude'    => ['required', 'numeric', 'between:-8.80,-7.30'],
            'longitude'   => ['required', 'numeric', 'between:113.40,114.70'],

            'nama_bank'          => ['required', Rule::in(Bakery::BANK)],
            'nomor_rekening'     => ['required', 'regex:/^[0-9]{6,20}$/'],
            'atas_nama_rekening' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'           => ':attribute wajib diisi.',
            'max'                => ':attribute terlalu panjang.',
            'in'                 => 'Pilihan :attribute tidak valid.',
            'numeric'            => ':attribute harus berupa angka.',
            'whatsapp.regex'     => 'Nomor WhatsApp harus diawali 08 atau +62 (contoh: 081234567890).',
            'latitude.between'   => 'Latitude di luar wilayah Banyuwangi. Cek lagi titik di Google Maps.',
            'longitude.between'  => 'Longitude di luar wilayah Banyuwangi. Cek lagi titik di Google Maps.',
            'nomor_rekening.regex' => 'Nomor rekening hanya boleh angka, 6 sampai 20 digit.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama'               => 'Nama toko',
            'jenis_usaha'        => 'Jenis usaha',
            'deskripsi'          => 'Deskripsi',
            'whatsapp'           => 'Nomor WhatsApp',
            'alamat'             => 'Alamat lengkap',
            'kecamatan'          => 'Kecamatan',
            'latitude'           => 'Latitude',
            'longitude'          => 'Longitude',
            'nama_bank'          => 'Bank',
            'nomor_rekening'     => 'Nomor rekening',
            'atas_nama_rekening' => 'Nama pemilik rekening',
        ];
    }
}
