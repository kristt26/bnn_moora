<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $user = new \App\Models\UserModel();
        if ($user->countAllResults() == 0) {
            $user->insert(['username' => 'Administrator', 'password' => password_hash('Administrator#1', PASSWORD_DEFAULT)]);
        }
        return view('login');
    }

    public function login()
    {
        $user = new \App\Models\UserModel();
        $data = $this->request->getJSON();
        $q = $user->where('username', $data->username)->first();
        if ($q) {
            if (password_verify($data->password, $q['password'])) {
                session()->set(['nama' => 'Administrator', 'isRole' => true]);
                return $this->respond(true);
            } else return $this->fail("Password salah");
        } else return $this->fail("Username tidak ditemukan");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }
}
