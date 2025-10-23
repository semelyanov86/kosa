<?php

namespace App\Data;

use Spatie\LaravelData\Data;

final class PaginationFilterData extends Data
{
    public function __construct(
        public int $page = 1,
        public int $perPage = 20,
    ) {}
}
