<?php

namespace App\Repositories\Files;

use App\Models\File;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class FileEloquentRepository extends EloquentRepository implements FileRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return File::class;
    }

    /**
     * Get all user files
     *
     * @param $userId
     * @param $paginate
     * @param $orderBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllUserFile($userId, $paginate, $orderBy)
    {
        return DB::table('files')
            ->where('user_id', '=', $userId)
            ->orderBy("id", $orderBy)
            ->paginate($paginate);
    }

    /**
     * Get total file user upload
     *
     * @param $userId
     * @return int
     */
    public function getTotalUserFile($userId)
    {
        return DB::table('files')
            ->where('user_id', '=', $userId)
            ->count();
    }

    /**
     * Get file last time upload
     *
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getLastTimeUpload($userId)
    {
        return DB::table('files')
            ->where('user_id', '=', $userId)
            ->orderByDesc("id")
            ->first();
    }
}
