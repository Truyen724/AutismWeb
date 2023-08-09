<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements IBaseRepository
{
    protected const PAGE_NUMBER = 1;
    protected const ARRAY_COLUMN_FILTER = ['itemsPerPage', 'page', 'sortBy', 'sortDesc', 'groupBy', 'groupDesc', 'mustSort', 'multiSort'];

    protected const STATUS_ACTIVE = 1;
    protected const STATUS_UNACTIVE = 0;

    protected $model;
    protected $filter;

    /**
     * Get the repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getModel(): Model
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        throw new ModelNotFoundException(
            'You must declare your repository $model attribute with an Illuminate\Database\Eloquent\Model '
                . 'namespace to use this feature.'
        );
    }

    public function get()
    {
        $data = request()->all();

        $page_size = isset($data['itemsPerPage']) ? (int) $data['itemsPerPage'] : PAGE_SIZE_ADMIN;
        $sort_by = $data['sortBy'] ?? '';
        $sort_desc = $data['sortDesc'] ?? 'DESC';

        $this->model->when($sort_by != '', function ($query) use ($sort_by, $sort_desc) {
            return $query->orderBy($sort_by, $sort_desc);
        }, function ($query) {
            return $query->orderBy("created_at", "DESC");
        });

        return $this->model->paginate($page_size);
    }

    public function getAll($columns = ['*'])
    {
        $data = $this->model->all($columns);
        $total = count($data);

        return ['total' => $total, 'data' => $data];
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function save($attributes = [])
    {
        return $this->model->save($attributes);
    }

    public function getTranslateById($id)
    {
        return $this->model->where('translate_id', $id)->get();
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            return $result->update($attributes) ? $result : false;
        }

        return false;
    }

    public function updateOrCreate($attributes = [], $value = [])
    {
        $result = $this->model->updateOrCreate($attributes, $value);
        return $result ? $result : false;
    }

    public function createOrUpdate($id, $attributes = [])
    {
        if ($id == null) {
            $attributes['id'] = generateRandomString();
            $result = $this->model->create($attributes);
        } else {
            $result = $this->model->where('id', $id)->update($attributes);
        }

        return $result ? $result : false;
    }

    public function delete($id)
    {
        $ids = explode(",", $id);

        $result = $this->model->whereIn('id', $ids)->delete();

        return $result ? $result : false;
    }

    public function beginTran()
    {
        DB::beginTransaction();
    }

    public function commitTran()
    {
        DB::commit();
    }

    public function rollbackTran()
    {
        DB::rollBack();
    }
}
