<?php

namespace App\Repositories\Packages;

use App\Models\Packages;
use App\Repositories\Eloquent\EloquentRepository;

class PackageEloquentRepository extends EloquentRepository implements PackageRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Packages::class;
    }
}
