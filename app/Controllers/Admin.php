<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $session;
    protected $userModel;
    protected $pdmModel;
    protected $tnhModel;
    protected $gdbModel;
    protected $jijModel;
    protected $atlModel;
    protected $kdpModel;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = model('UserModel', true, $db);
        $this->pdmModel = model('PdmModel', true, $db);
        $this->tnhModel = model('TnhModel', true, $db);
        $this->gdbModel = model('GdbModel', true, $db);
        $this->jijModel = model('JijModel', true, $db);
        $this->atlModel = model('AtlModel', true, $db);
        $this->kdpModel = model('KdpModel', true, $db);
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
                setcookie('updateemail', 'conflict', time() + 5, '/');
            } else {
                if ($this->userModel->where('id', $id)->set('email', $email)->update()) {
                    $this->session->set('dbmn_user_session', $email);
                    setcookie('updateemail', 'success', time() + 5, '/');
                } else {
                    setcookie('updateemail', 'failed', time() + 5, '/');
                }
            }
        }
        return redirect()->to(HOST_URL . '/admin/user-management');
    }

    /**
     * PDM
     */

    public function pdmdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['pdmdata'] = $this->pdmModel->findAll();

        return view('admin/pdm', $data);
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
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
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
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

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
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


    /**
     * TNH
     */

    public function tnhdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['tnhdata'] = $this->tnhModel->findAll();

        return view('admin/tnh', $data);
    }

    public function tnhupload()
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->tnhModel->where('uid', $uid)->find()) {
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
                            $this->tnhModel->where('uid', $uid)->set($data)->update();
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
                            $this->tnhModel->insert($data);
                        }
                    }
                }
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->tnhModel->where('uid', $uid)->find()) {
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
                            $this->tnhModel->where('uid', $uid)->set($data)->update();
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
                            $this->tnhModel->insert($data);
                        }
                    }
                }
            }

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
    }

    public function tnhdetail()
    {
        $id = $_POST['id'];

        $detail = $this->tnhModel->find($id);
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

    public function tnhdelete()
    {
        $id = $_POST['id'];

        if ($this->tnhModel->find($id)) {
            if ($this->tnhModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
        }
    }


    /**
     * GDB
     */

    public function gdbdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['gdbdata'] = $this->gdbModel->findAll();

        return view('admin/gdb', $data);
    }

    public function gdbupload()
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->gdbModel->where('uid', $uid)->find()) {
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
                            $this->gdbModel->where('uid', $uid)->set($data)->update();
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
                            $this->gdbModel->insert($data);
                        }
                    }
                }
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->gdbModel->where('uid', $uid)->find()) {
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
                            $this->gdbModel->where('uid', $uid)->set($data)->update();
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
                            $this->gdbModel->insert($data);
                        }
                    }
                }
            }

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
    }

    public function gdbdetail()
    {
        $id = $_POST['id'];

        $detail = $this->gdbModel->find($id);
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

    public function gdbdelete()
    {
        $id = $_POST['id'];

        if ($this->gdbModel->find($id)) {
            if ($this->gdbModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
        }
    }

    /**
     * JIJ
     */

    public function jijdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['jijdata'] = $this->jijModel->findAll();

        return view('admin/jij', $data);
    }

    public function jijupload()
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->jijModel->where('uid', $uid)->find()) {
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
                            $this->jijModel->where('uid', $uid)->set($data)->update();
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
                            $this->jijModel->insert($data);
                        }
                    }
                }
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->jijModel->where('uid', $uid)->find()) {
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
                            $this->jijModel->where('uid', $uid)->set($data)->update();
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
                            $this->jijModel->insert($data);
                        }
                    }
                }
            }

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
    }

    public function jijdetail()
    {
        $id = $_POST['id'];

        $detail = $this->jijModel->find($id);
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

    public function jijdelete()
    {
        $id = $_POST['id'];

        if ($this->jijModel->find($id)) {
            if ($this->jijModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
        }
    }


    /**
     * ATL
     */

    public function atldata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['atldata'] = $this->atlModel->findAll();

        return view('admin/atl', $data);
    }

    public function atlupload()
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->atlModel->where('uid', $uid)->find()) {
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
                            $this->atlModel->where('uid', $uid)->set($data)->update();
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
                            $this->atlModel->insert($data);
                        }
                    }
                }
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->atlModel->where('uid', $uid)->find()) {
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
                            $this->atlModel->where('uid', $uid)->set($data)->update();
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
                            $this->atlModel->insert($data);
                        }
                    }
                }
            }

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
    }

    public function atldetail()
    {
        $id = $_POST['id'];

        $detail = $this->atlModel->find($id);
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

    public function atldelete()
    {
        $id = $_POST['id'];

        if ($this->atlModel->find($id)) {
            if ($this->atlModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
        }
    }


    /**
     * KDP
     */

    public function kdpdata()
    {
        $data['session'] = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->findAll();
        $data['kdpdata'] = $this->kdpModel->findAll();

        return view('admin/kdp', $data);
    }

    public function kdpupload()
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


            // Session Data
            $session_data = $this->userModel->where('email', $this->session->get('dbmn_user_session'))->find();

            $firstline = fgetcsv($csvFile);
            // checking is comma or semicolon separated
            if (isset($firstline[3]) && isset($firstline[5]) && isset($firstline[7]) && isset($firstline[10])) {;
                while (($datacsv = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->kdpModel->where('uid', $uid)->find()) {
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
                            $this->kdpModel->where('uid', $uid)->set($data)->update();
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
                            $this->kdpModel->insert($data);
                        }
                    }
                }
            } else {
                while (($datacsv = fgetcsv($csvFile, 10000, ";")) !== FALSE) {

                    if ($datacsv[0] != '' && $datacsv[2] != '') {
                        $uid = str_replace(".", '', $datacsv[2]) . $datacsv[3];
                        if ($this->kdpModel->where('uid', $uid)->find()) {
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
                            $this->kdpModel->where('uid', $uid)->set($data)->update();
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
                            $this->kdpModel->insert($data);
                        }
                    }
                }
            }

            // Parse data from CSV file line by line

        } else {
            setcookie('uploaddata', 'unsupported', time() + 5);
        }
        if (!isset($_COOKIE['uploaddata'])) {
            setcookie('uploaddata', 'success', time() + 5);
        }
        return redirect()->to(HOST_URL . '/admin/data/peralatan-dan-mesin');
    }

    public function kdpdetail()
    {
        $id = $_POST['id'];

        $detail = $this->kdpModel->find($id);
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

    public function kdpdelete()
    {
        $id = $_POST['id'];

        if ($this->kdpModel->find($id)) {
            if ($this->kdpModel->delete($id)) {
                return 'deleted';
            } else {
                return 'failed';
            }
        } else {
            return 'notfound';
        }
    }
}
