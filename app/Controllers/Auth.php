<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $session;
    protected $userModel;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = model('UserModel', true, $db);
    }


    public function login()
    {

        if ($this->session->has('dbmn_user_session')) {
            $user = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();
            if ($user[0]['role'] == 'admin') {
                return redirect()->to(HOST_URL . '/admin');
            } elseif ($user[0]['role'] == 'pdm') {
                return redirect()->to(HOST_URL . '/pdm');
            } // more else if here if needed
            else {
                return redirect()->to(HOST_URL . '/logout');
            }
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $email  = $_POST['email'];
        $password  = $_POST['password'];

        if ($user = $this->userModel->where('email', $email)->find()) {
            if (password_verify($password, $user[0]['password'])) {
                $this->session->set('dbmn_user_session', $email);
                return redirect()->to(HOST_URL . '/admin');
            } else {
                setcookie('auth', 'mismatch', time() + 10);
                return redirect()->to(HOST_URL . '/login');
            }
        } else {
            setcookie('auth', 'notfound', time() + 10);
            return redirect()->to(HOST_URL . '/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(HOST_URL);
    }
}
