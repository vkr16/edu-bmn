<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $session;
    protected $userModel;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = model('UserModel', true, $db);
    }
    public function index()
    {
        //
        return redirect()->to(HOST_URL . '/admin/user-management');
    }

    public function usermanagement()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['users'] = $this->userModel->findAll();

        return view('admin/user-management', $data);
    }

    public function adduser()
    {
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $role       = $_POST['role'];
        $password   = $_POST['password'];

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
        ];

        if (!$this->userModel->where('email', $email)->findAll()) {

            if ($this->userModel->insert($data)) {
                setcookie('adduser', 'success', time() + 5);
            } else {
                setcookie('adduser', 'failed', time() + 5);
            }
        } else {
            setcookie('adduser', 'conflict', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/user-management');
    }

    public function edituser()
    {
        $id = $_POST['id'];
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $oldmail      = $_POST['oldmail'];
        $role       = $_POST['role'];

        if ($email == $oldmail) {
            $data = [
                'name' => $name,
                'role' => $role
            ];
        } else {
            if (!$this->userModel->where('email', $email)->findAll()) {
                $data = [
                    'name' => $name,
                    'role' => $role,
                    'email' => $email
                ];
            } else {
                setcookie('edituser', 'conflict', time() + 5);
                return redirect()->to(HOST_URL . '/admin/user-management');
            }
        }

        if ($this->userModel->where('id', $id)->set($data)->update()) {
            setcookie('edituser', 'updated', time() + 5);
        } else {
            setcookie('edituser', 'failed', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/user-management');
    }

    public function resetpassuser()
    {
        $id = $_POST['id'];
        $password = $_POST['password'];

        if ($this->userModel->where('id', $id)->set('password', password_hash($password, PASSWORD_DEFAULT))->update()) {
            setcookie('reset', 'done', time() + 5);
        } else {
            setcookie('reset', 'failed', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/user-management');
    }

    public function deleteuser()
    {
        $id = $_POST['id'];

        if ($this->userModel->findAll($id)) {
            if ($this->userModel->delete($id)) {
                return "deleted";
            } else {
                return "failed";
            }
        } else {
            return "not found";
        }
    }

    public function updatepassword()
    {
        $id = $_POST['id'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($this->userModel->where('id', $id)->set('password', $password)->update()) {
            return 'success';
        } else {
            return 'failed';
        }
    }

    public function updateemail()
    {
        $id = $_POST['id'];
        $email = $_POST['email'];

        $current = $this->userModel->find($id);

        $current_email = $current['email'];

        if ($email != $current_email) {
            if ($this->userModel->where('email', $email)->find()) {
                setcookie('updateemail', 'conflict', time() + 10, '/');
            } else {
                if ($this->userModel->where('id', $id)->set('email', $email)->update()) {
                    $this->session->set('dbmn_user_session', $email);
                    setcookie('updateemail', 'success', time() + 10, '/');
                } else {
                    setcookie('updateemail', 'failed', time() + 10, '/');
                }
            }
        }
        return redirect()->to(HOST_URL . '/admin/user-management');
    }
}
