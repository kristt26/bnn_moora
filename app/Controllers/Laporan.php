<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use ocs\spklib\Moora as moora;

class Laporan extends BaseController
{
    use ResponseTrait;
    protected $periode;
    protected $kriteria;
    protected $alternatif;
    protected $preferensi;
    public function __construct() {
        $this->periode = new \App\Models\PeriodeModel();
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->alternatif = new \App\Models\AlternatifModel();
        $this->preferensi = new \App\Models\PreferensiModel();
    }
    public function index()
    {
        return view('laporan');
    }
    public function hitung()
    {
        $data = $this->request->getJSON();
        try {
            $kriterias = $this->kriteria->findAll();
            $alternatifs = $this->alternatif->where('periode_id', $data->id)->findAll();
            $result = array();
            foreach ($alternatifs as $key => $alternatif) {
                $alternatif['nilai'] = array();
                foreach ($kriterias as $key => $kriteria) {
                    $kriterias[$key]['bobot'] = (int) $kriterias[$key]['bobot'];
                    $item = $this->preferensi->where('alternatif_id', $alternatif['id'])->where('kriteria_id', $kriteria['id'])->first();
                    $item['kode']=$kriteria['kode'];
                    $item['bobot'] = (int) $item['bobot'];
                    $alternatif['nilai'][] = $item;
                }
                $result[]=$alternatif;
            }
            $htg = new moora($kriterias,$result,7);
            return $this->respond($htg);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
