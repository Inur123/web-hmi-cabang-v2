<?php

namespace App\Livewire\User\Permohonan;

use Livewire\Component;
use App\Models\Permohonan as PermohonanModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

#[Layout('components.layouts.guest')]
#[Title('Permohonan')]
class Permohonan extends Component
{
    public $nama_lengkap = '';
    public $nomor_hp = '';
    public $alamat = '';
    public $kebutuhan = '';
    public $deskripsi = '';
    public $persyaratan = '';

    public $recaptchaToken = null;

    protected $rules = [
        'nama_lengkap' => 'required|string|min:3|max:100',
        'nomor_hp' => [
            'required',
            'regex:/^(?:\+62|62|08)[0-9]{8,12}$/'
        ],
        'alamat' => 'required|string|min:5|max:255',
        'kebutuhan' => 'required|in:Rekomendasi,Permohonan SK,Surat Keterangan',
        'deskripsi' => 'required|string|min:10|max:1000',
        'persyaratan' => 'required|string|min:5|max:1000',
        'recaptchaToken' => 'required',
    ];

    protected $messages = [
        'kebutuhan.required' => 'Silakan pilih kebutuhan',
        'kebutuhan.in' => 'Pilihan kebutuhan tidak valid',
        'recaptchaToken.required' => 'Silakan centang reCAPTCHA',
    ];

    private function sanitizeInput()
    {
        $this->nama_lengkap = trim(strip_tags($this->nama_lengkap));
        $this->nomor_hp = preg_replace('/[^0-9\+]/', '', $this->nomor_hp);
        $this->alamat = trim(strip_tags($this->alamat));
        $this->deskripsi = trim(strip_tags($this->deskripsi));
        $this->persyaratan = trim(strip_tags($this->persyaratan));
    }

    private function verifyRecaptchaV2()
    {
        try {
             /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha_v2.secret'),
                    'response' => $this->recaptchaToken,
                    'remoteip' => request()->ip(),
                ]
            );

            return ($response->object()->success ?? false);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function submit()
    {
        $this->sanitizeInput();
        $this->validate();

        if (!$this->verifyRecaptchaV2()) {
            $this->addError('recaptchaToken', 'Verifikasi reCAPTCHA gagal');
            return;
        }

        PermohonanModel::create([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_hp' => $this->nomor_hp,
            'alamat' => $this->alamat,
            'kebutuhan' => $this->kebutuhan,
            'deskripsi' => $this->deskripsi,
            'persyaratan' => $this->persyaratan,
        ]);

        $this->reset();

        session()->flash('success', 'Permohonan berhasil dikirim.');
        $this->dispatch('reset-recaptcha');
    }

    public function render()
    {
        return view('livewire.user.permohonan.permohonan');
    }
}
