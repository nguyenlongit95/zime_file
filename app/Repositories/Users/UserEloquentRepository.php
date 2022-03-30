<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * CheckRole user/admin function
     *
     * @param $userId
     * @return
     */
    public function checkRole($userId)
    {
        $user = DB::table("users")
            ->where('id', $userId)
            ->first();
        if($user->role) {
            return true;
        }
    }

    /**
     * Get all user from database
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUsers($paginate, $orderBy)
    {
        return DB::table("users")
            ->where('role', config("const.user.user"))
            ->orderBy("id", $orderBy)
            ->paginate($paginate);
    }
}
