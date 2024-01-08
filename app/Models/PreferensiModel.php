<?php

namespace App\Models;

use CodeIgniter\Model;

class PreferensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'preferensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kriteria_id', 'alternatif_id', 'value', 'bobot'];
}
