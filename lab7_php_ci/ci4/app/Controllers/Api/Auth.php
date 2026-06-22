<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $model = new UserModel();

        // Cari berdasarkan username ATAU email
        $user = $model->where('username', $username)
                      ->orWhere('useremail', $username)
                      ->first();

        if ($user) {
            // Verifikasi password dengan password_verify (sesuai P4)
            if (password_verify($password, $user['userpassword'])) {

                // Login berhasil → kirim token
                return $this->respond([
                    'status'   => 200,
                    'error'    => null,
                    'messages' => 'Login Berhasil',
                    'data'     => [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'token'    => base64_encode('TOKEN-SECRET-' . $user['username']),
                    ]
                ], 200);
            }
        }

        // Login gagal → kirim error 401
        return $this->failUnauthorized('Username atau Password salah.');
    }
}