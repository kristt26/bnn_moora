<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use ocs\spklib\Moora as moora;

class Alternatif extends BaseController
{
    use ResponseTrait;
    protected $kriteria;
    protected $range;
    protected $decode;
    protected $alternatif;
    protected $preferensi;
    protected $db;
    protected $periode;
    public function __construct()
    {
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->range = new \App\Models\RangeModel();
        $this->decode = new \App\Libraries\Decode();
        $this->alternatif = new \App\Models\AlternatifModel();
        $this->preferensi = new \App\Models\PreferensiModel();
        $this->db = \Config\Database::connect();
        $this->periode = new \App\Models\PeriodeModel();
    }
    public function index()
    {
        return view('alternatif');
    }

    public function set_data()
    {
        try {
            $data= $this->request->getJSON();
            return $this->respond($item = $this->toJson($this->decode->decodebase64($data->base64)));
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
        
    }

    public function range($id = null)
    {
        return view('kriteria');
    }
    public function read()
    {
        try {
            $data = $this->kriteria->asObject()->findAll();
            foreach ($data as $key => $value) {
                $value->range = $this->range->where('kriteria_id', $value->id)->findAll();
            }
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $periode = $this->periode->asObject()->where('status', '1')->first();
        try {
            $this->db->transException(true)->transStart();
            if($this->periode->countAllResults()>0){
                $this->alternatif->where('periode_id', $periode->id)->delete();
            } 
            foreach ($data as $key1 => $alternatif) {
                $alternatif->periode_id = $periode->id;
                $this->alternatif->insert($alternatif);
                $alternatif->id = $this->alternatif->getInsertID();
                foreach ($alternatif->nilai as $key2 => $nilai) {
                    $nilai->alternatif_id = $alternatif->id;
                    $nilai->periode_id = $periode->id;
                    $this->preferensi->insert($nilai);
                    $nilai->id = $this->preferensi->getInsertID();
                }
            }
            $this->db->transComplete();
        } catch (DatabaseException $e) {
            return $this->fail($e->getMessage());
        }
    }
    public function put()
    {
        try {
            $data = $this->request->getJSON();
            if ($this->kriteria->update($data->id, $data)) {
                return $this->respondUpdated(true);
            }
            throw new \Exception("Gagal mengubah", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function deleted($id = null)
    {
        try {
            if ($this->kriteria->delete($id));
            return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    protected function toJson(string $file):array
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);

        // setting nama file yg akan dibaca
        $spreadsheet = $reader->load("berkas/".$file);

        // data worksheet yg akan dibaca ada di active sheet
        $worksheet = $spreadsheet->getActiveSheet();

        // mendapatkan maks nomor baris data
        $highestRow = $worksheet->getHighestRow();
        // mendapatkan maks kolom data
        $highestColumn = $worksheet->getHighestColumn();

        // mendapatkan nama-nama kolom data 
        // membaca value yang ada di cell: A1, B1, ..., E1
        // dan simpan ke dalam array $colsName
        $colsName = array();
        for ($col = 'A'; $col <= "B"; $col++) {
            $colsName[] =  $worksheet->getCell($col . 1)->getValue();
        }
        $colsName[] =  "bobot";

        // inisialisasi array untuk menampung semua data
        $dataAll = array();
        for ($row=1; $row < $highestRow ; $row++) { 
            $item = [
                'nama' => $worksheet->getCell("A" . $row+1)->getValue(),
                'kode' => $worksheet->getCell("B" . $row+1)->getValue(),
                'nilai' => array()
            ];
            for ($col="C"; $col <= $highestColumn ; $col++) { 
                $nilai = [
                    'kode' => $worksheet->getCell($col . "1")->getValue(),
                    'value' => floatval($worksheet->getCell($col . $row+1)->getValue()),
                ];
                array_push($item['nilai'], $nilai);
            }
            array_push($dataAll, $item);
        }

        return $dataAll;
    }
}
