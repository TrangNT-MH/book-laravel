<?php

namespace App\Repositories;

abstract class EloquentRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }
    abstract function getModel();

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        $this->model->findOrFail($id);
        return $this->model->destroy($id);
    }
}
