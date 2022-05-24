<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_artikel';
    protected $primaryKey       = 'id_artikel';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_artikel', 'id_user', 'judul', 'isi'];

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getArtikel($id = false)
    {
        if ($id == false) {
            return $this->db->table('list_artikel')
                ->get()->getResultArray();
        }

        return $this->db->table('list_artikel')
            ->where(['id_artikel' => $id])->get()->getRowArray();
    }
}
