<?php

namespace App\Models;

use CodeIgniter\Model;

class GdbModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gdbs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['uid', 'kode_barang', 'nup', 'nama_barang', 'kuantitas', 'perolehan', 'no_sk', 'tanggal_sk', 'instansi_sk', 'sesuai', 'tidak_sesuai', 'pihak_lain', 'keterangan', 'last_editor'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
