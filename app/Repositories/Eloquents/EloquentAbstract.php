<?php

namespace App\Repositories\Eloquents;


use App\Repositories\Constracts\BaseRepositoryInterface;
// use Illuminate\Container\Container as App;
// use Illuminate\Database\Eloquent\Model;
/**
 *
 */
abstract class EloquentAbstract
{

    protected $model;


    public function all($columns = array('*'), $limit = 10) {
        return $this->model->orderBy('created_at', 'desc')->take($limit)->get($columns);
    }

    public function find($id,$columns = array('*')) {
        return $this->model->find($id,$columns);
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function paginate ($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = 'id') {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id,$attribute = 'id') {
        return $this->model->where($attribute, '=', $id)->delete();
    }

}

?>
