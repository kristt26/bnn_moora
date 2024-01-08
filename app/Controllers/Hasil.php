<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use ocs\spklib\Moora as moora;

class Hasil extends BaseController
{
    use ResponseTrait;
    protected $periode;
    protected $kriteria;
    protected $client;
    protected $preferensi;
    public function __construct() {
        $this->periode = new \App\Models\PeriodeModel();
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->client = new \App\Models\ClientModel();
        $this->preferensi = new \App\Models\PreferensiModel();
    }
    public function index()
    {
        return view('hasil');
    }
    public function hitung()
    {
        try {
            $kriterias = $this->kriteria->findAll();
            $alternatifs = $this->client->select("alternatif.*")->join("periode", "periode.id=alternatif.periode_id")->where("periode.status", "1")->findAll();
            $result = array();
            foreach ($alternatifs as $key => $alternatif) {
                $alternatif['nilai'] = array();
                foreach ($kriterias as $key => $kriteria) {
                    $kriterias[$key]['bobot'] = (int) $kriterias[$key]['bobot'];
                    $item = $this->preferensi->where('alternatif_id', $alternatif['id'])->where('kriteria_id', $kriteria['id'])->first();
                    $item['kode']=$kriteria['kode'];
                    $item['bobot'] = (int) $item['value'];
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
