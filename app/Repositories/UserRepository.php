<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function addresses($id)
    {
        return $this->model->find($id)->addresses->toArray();
    }

    public function detail($id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first()->id;
    }

    public function updatePassword($email, $password)
    {
        return $this->model
            ->where('email', $email)
            ->update([
                'password' => $password
            ]);
    }

    public function user_info()
    {
        return $this->model->user_infos();
    }
}
