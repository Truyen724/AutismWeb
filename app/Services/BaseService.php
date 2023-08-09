<?php

namespace App\Services;

abstract class BaseService
{
    protected $repo;

    public function get()
    {
        $model = $this->repo->get();
        return $model;
    }

    public function getAll()
    {
        try {
            $query = $this->repo->getAll();
            return $query;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function detail($id)
    {
        try {
            $query = $this->repo->find($id);
            return $query;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function create($data)
    {
        $keyType = $this->repo->getModel()->getKeyType();
        $primaryKey = $this->repo->getModel()->getPrimaryKey();

        if ($keyType == 'string' &&  !isset($data[$primaryKey]))
            $data[$primaryKey] = generateRandomString();
        $data['created_by'] = auth()->id();
        $data['updated_by'] = $data['created_by'];

        return $this->repo->create($data);
    }

    public function update($data)
    {
        $data['updated_by'] = auth()->id();

        return $this->repo->update($data['id'], $data);
    }

    public function delete($id)
    {
        $query = $this->repo->delete($id);
        return $query;
    }
}
