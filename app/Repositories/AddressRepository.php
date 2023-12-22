<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\EloquentRepository;

class AddressRepository extends EloquentRepository
{

    function getModel()
    {
        return Address::class;
    }

    public function updateDefault($id)
    {
        $address = $this->model->where('user_id', $id)->where('is_default', 1);
        $address->update(['is_default' => 0]);
    }
}
