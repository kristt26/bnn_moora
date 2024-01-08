<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Client extends BaseController
{
    use ResponseTrait;
    protected $client;
    protected $periode;
    public function __construct() {
        $this->client = new \App\Models\ClientModel();
        $this->periode = new \App\Models\PeriodeModel();
    }
    public function index()
    {
        return view('client');
    }
    public function read()
    {
        try {
            return $this->respond($this->client->select("alternatif.*")->join("periode", "periode.id=alternatif.periode_id")->where("periode.status", "1")->findAll());
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function post()
    {
        try {
            $periode = $this->periode->where("status", "1")->first();
            $data = $this->request->getJSON();
            $data->periode_id = $periode['id'];
            if($this->client->insert($data)){
                return $this->respondCreated($this->client->getInsertID());
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
            if($this->client->update($data->id, $data)){
                return $this->respondUpdated(true);
            }
            throw new \Exception("Gagal mengubah", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
    public function deleted($id = null)
    {
        if($this->client->delete($id)) return $this->respondDeleted(true);
        return $this->fail("Gagal hapus");
    }
}
