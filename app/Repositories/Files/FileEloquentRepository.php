<?php

namespace App\Repositories\Files;

use App\Models\File;
use App\Repositories\Eloquent\EloquentRepository;

class FileEloquentRepository extends EloquentRepository implements FileRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return File::class;
    }
}
