<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function getModel(): Model;

    public function get();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Save
     * @param array $attributes
     * @return mixed
     */
    public function save($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Create new record or update record
     * @param array $value
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate($attributes = [], $value = []);

    /**
     * Create new record or update record
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function createOrUpdate(int $id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    public function beginTran();
    public function commitTran();
    public function rollbackTran();
}