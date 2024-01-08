<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Range extends BaseController
{
    use ResponseTrait;
    protected $range;
    public function __construct() {
        $this->range = new \App\Models\RangeModel();
    }
    
    public function read()
    {
        try {
            return $this->respond($this->range->findAll());
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function post()
    {
        try {
            if($this->range->insert($this->request->getJSON())){
                return $this->respondCreated($this->range->getInsertID());
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
            if($this->range->update($data->id, $data)){
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
            if($this->range->delete($id));
            return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
