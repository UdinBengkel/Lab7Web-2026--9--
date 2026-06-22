<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title'   => 'Halaman About',
            'content' => 'Ini adalah halaman About yang menjelaskan tentang isi halaman ini.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title'   => 'Halaman Contact',
            'content' => 'Hubungi kami melalui email: admin@example.com atau telepon di 021-12345678.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title'   => 'Frequently Asked Questions (FAQ)',
            'content' => 'Berikut adalah daftar pertanyaan yang sering diajukan oleh pengguna kami.'
        ]);
    }

    public function tos()
    {
        return view('tos', [
            'title'   => 'Terms of Service',
            'content' => 'Dengan menggunakan layanan kami, Anda menyetujui syarat dan ketentuan yang berlaku.'
        ]);
    }
}