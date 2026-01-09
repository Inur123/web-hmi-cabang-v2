<?php

namespace App\Livewire\User\Aduan;

use Livewire\Component;
use App\Models\Aduan as AduanModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

#[Layout('components.layouts.guest')]
#[Title('Aduan')]
class Aduan extends Component
{
    public $nama_lengkap = '';
    public $nomor_hp = '';
    public $alamat = '';
    public $isi_aduan = '';

    // ✅ token reCAPTCHA v2
    public $recaptchaToken = null;

    protected $rules = [
        // ✅ Nama hanya huruf & spasi (boleh titik dan koma jika mau)
        'nama_lengkap' => [
            'required',
            'string',
            'min:3',
            'max:100',
            'regex:/^[a-zA-Z\s\.\'-]+$/'
        ],

        // ✅ Nomor HP hanya angka, boleh diawali +62 atau 08
        'nomor_hp' => [
            'required',
            'string',
            'min:10',
            'max:15',
            'regex:/^(?:\+62|62|08)[0-9]{8,12}$/'
        ],

        // ✅ Alamat minimal 5 dan max 255
        'alamat' => [
            'required',
            'string',
            'min:5',
            'max:255'
        ],

        // ✅ Isi aduan minimal 10, max 1000
        // ✅ prevent script injection
        'isi_aduan' => [
            'required',
            'string',
            'min:10',
            'max:1000',
            'not_regex:/<script\b[^>]*>(.*?)<\/script>/is',
            'not_regex:/javascript:/i',
        ],

        // ✅ wajib recaptcha
        'recaptchaToken' => 'required',
    ];

    protected $messages = [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi',
        'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter',
        'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter',
        'nama_lengkap.regex' => 'Nama lengkap hanya boleh huruf dan spasi',

        'nomor_hp.required' => 'Nomor HP wajib diisi',
        'nomor_hp.min' => 'Nomor HP minimal 10 digit',
        'nomor_hp.max' => 'Nomor HP maksimal 15 digit',
        'nomor_hp.regex' => 'Format nomor HP tidak valid (contoh: 08xxxx / +62xxxx)',

        'alamat.required' => 'Alamat wajib diisi',
        'alamat.min' => 'Alamat minimal 5 karakter',
        'alamat.max' => 'Alamat maksimal 255 karakter',

        'isi_aduan.required' => 'Isi aduan wajib diisi',
        'isi_aduan.min' => 'Isi aduan minimal 10 karakter',
        'isi_aduan.max' => 'Isi aduan maksimal 1000 karakter',
        'isi_aduan.not_regex' => 'Isi aduan tidak boleh mengandung script atau kode berbahaya',

        'recaptchaToken.required' => 'Silakan centang reCAPTCHA terlebih dahulu.',
    ];

    /**
     * ✅ Sanitasi input agar aman dari XSS / karakter aneh
     */
    private function sanitizeInput()
    {
        $this->nama_lengkap = trim(strip_tags($this->nama_lengkap));
        $this->nomor_hp = preg_replace('/[^0-9\+]/', '', trim($this->nomor_hp));
        $this->alamat = trim(strip_tags($this->alamat));
        $this->isi_aduan = trim(strip_tags($this->isi_aduan));

        // ✅ Remove multiple spaces
        $this->nama_lengkap = preg_replace('/\s+/', ' ', $this->nama_lengkap);
        $this->alamat = preg_replace('/\s+/', ' ', $this->alamat);
        $this->isi_aduan = preg_replace('/\s+/', ' ', $this->isi_aduan);
    }

    /**
     * ✅ Live validation saat user mengetik (optional)
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /** ✅ Verifikasi reCAPTCHA v2 */
    private function verifyRecaptchaV2()
    {
        try {
            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::timeout(5)->asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha_v2.secret'),
                    'response' => $this->recaptchaToken,
                    'remoteip' => request()->ip(),
                ]
            );

            $result = $response->object();
            return ($result && ($result->success ?? false)) ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /** Submit aduan (store only) */
    public function submit()
    {
        $this->sanitizeInput();
        $this->validate();

        // ✅ Protection tambahan: isi aduan tidak boleh terlalu banyak karakter spesial
        if (Str::length(preg_replace('/[a-zA-Z0-9\s]/', '', $this->isi_aduan)) > 300) {
            $this->addError('isi_aduan', 'Isi aduan terlalu banyak simbol, harap gunakan kata-kata yang jelas.');
            return;
        }

        // ✅ Verify Recaptcha v2
        if (!$this->verifyRecaptchaV2()) {
            $this->addError('recaptchaToken', 'Verifikasi reCAPTCHA gagal. Silakan ulangi.');
            $this->recaptchaToken = null;
            return;
        }

        AduanModel::create([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_hp' => $this->nomor_hp,
            'alamat' => $this->alamat,
            'isi_aduan' => $this->isi_aduan,
        ]);

        $this->reset(['nama_lengkap', 'nomor_hp', 'alamat', 'isi_aduan', 'recaptchaToken']);

        session()->flash('success', 'Aduan berhasil dikirim! Terima kasih atas masukannya.');

        // ✅ Reset captcha client-side
        $this->dispatch('reset-recaptcha');
    }

    public function render()
    {
        return view('livewire.user.aduan.aduan');
    }
}
