<?php

namespace App\Interfaces;


use Illuminate\Contracts\Pagination\Paginator;

interface DBPrepareableInterface
{
    public function prepareForBD(array $data): array;
}
