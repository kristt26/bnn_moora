<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Periode extends BaseController
{
    use ResponseTrait;
    protected $periode;
    public function __construct() {
        $this->periode = new \App\Models\PeriodeModel();
    }
    public function index()
    {
        return view('periode');
    }
    public function read()
    {
        try {
            return $this->respond($this->periode->findAll());
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function post()
    {
        try {
            if ($this->periode->where('status', '1')->set('status', '0')->update()) {
                if($this->periode->insert($this->request->getJSON())){
                    return $this->respondCreated($this->periode->getInsertID());
                }
            }
            throw new \Exception("Gagal menyimpan", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function put()
    {
        try {
            $data = $this->request->getJSON();
            if($this->periode->update($data->id, $data)){
                return $this->respondUpdated(true);
            }
            throw new \Exception("Gagal mengubah", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function deleted()
    {
        //
    }
}
