<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pdm extends BaseController
{
    protected $session;
    protected $userModel;
    protected $pdmModel;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = model('UserModel', true, $db);
        $this->pdmModel = model('PdmModel', true, $db);
    }
    public function index()
    {
        return redirect()->to(HOST_URL . '/pdm/data/peralatan-dan-mesin');
    }

    public function pdmdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();
        $data['pdmdata'] = $this->pdmModel->findAll();
        return view('user/pdm/pdm.php', $data);
    }

    public function pdmupload()
    {
        // Allowed mime types
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            // Parse data from CSV file line by line
            while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                if ($datacsv[0] != '' && $datacsv[2] != '') {
                    $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                    var_dump($uid);
                    if ($this->pdmModel->where('uid', $uid)->find()) {
                        $data = [
                            'nama_barang' => $datacsv[4],
                            'kuantitas' => $datacsv[5],
                            'perolehan' => $datacsv[6],
                            'no_sk' => $datacsv[7],
                            'tanggal_sk' => $datacsv[8],
                            'instansi_sk' => $datacsv[9],
                            'sesuai' => $datacsv[10],
                            'tidak_sesuai' => $datacsv[11],
                            'pihak_lain' => $datacsv[12],
                            'keterangan' => $datacsv[13],
                            'last_editor' => $session_data[0]['id'],
                        ];
                        $this->pdmModel->where('uid', $uid)->set($data)->update();
                    } else {
                        $data = [
                            'uid' => $uid,
                            'kode_barang' => $datacsv[2],
                            'nup' => $datacsv[3],
                            'nama_barang' => $datacsv[4],
                            'kuantitas' => $datacsv[5],
                            'perolehan' => $datacsv[6],
                            'no_sk' => $datacsv[7],
                            'tanggal_sk' => $datacsv[8],
                            'instansi_sk' => $datacsv[9],
                            'sesuai' => $datacsv[10],
                            'tidak_sesuai' => $datacsv[11],
                            'pihak_lain' => $datacsv[12],
                            'keterangan' => $datacsv[13],
                            'last_editor' => $session_data[0]['id'],
                        ];
                        $this->pdmModel->insert($data);
                    }
                }
            }
        }
        return redirect()->to(HOST_URL . '/pdm/data/peralatan-dan-mesin');
    }

    public function pdmdetail()
    {
        $id = $_POST['id'];

        $detail = $this->pdmModel->find($id);
        $editor = $this->userModel->find($detail['last_editor']);

        $data = [
            'id' => $detail['id'],
            'uid' => $detail['uid'],
            'kode_barang' => $detail['kode_barang'],
            'nup' => $detail['nup'],
            'nama_barang' => $detail['nama_barang'],
            'kuantitas' => $detail['kuantitas'],
            'perolehan' => $detail['perolehan'],
            'no_sk' => $detail['no_sk'],
            'tanggal_sk' => $detail['tanggal_sk'],
            'instansi_sk' => $detail['instansi_sk'],
            'sesuai' => $detail['sesuai'],
            'tidak_sesuai' => $detail['tidak_sesuai'],
            'pihak_lain' => $detail['pihak_lain'],
            'keterangan' => $detail['keterangan'],
            'last_editor' => $editor['name'],
            'last_update' => date_format(date_create($detail['updated_at']), 'd/m/Y H:i:s '),
        ];

        return json_encode($data);
    }

    public function pdmdelete()
    {
        $id = $_POST['id'];

        if ($this->pdmModel->find($id)) {
            if ($this->pdmModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
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
        return redirect()->to(HOST_URL . '/pdm');
    }
}
