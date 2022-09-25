<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $userModel;
    protected $pdmModel;
    function __construct()
    {
        $this->userModel = model('UserModel', true, $db);
        $this->pdmModel = model('PdmModel', true, $db);
    }
    public function index()
    {
        return view('welcome_message');
    }

    public function pdmdata()
    {
        if (!isset($_GET['uid']) || $_GET['uid'] == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $uid = $_GET['uid'];
            if ($data['pdmdata'] = $this->pdmModel->where('uid', $uid)->find()) {
                $data['category'] = 'pdm';
                return view('public/data', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}
