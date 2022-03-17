<?php

namespace App\Repositories\Files;

use App\Models\Files;
use App\Repositories\Eloquent\EloquentRepository;

class FileEloquentRepository extends EloquentRepository implements FileRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Files::class;
    }
}
