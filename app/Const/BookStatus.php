<?php

namespace App\Const;

class BookStatus
{
    const ACTIVE = 1;
    const  INACTIVE = 2;

    public const BookStatus = [
        self::ACTIVE => 'active',
        self::INACTIVE => 'inactive'
    ];
}
