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

    /**
     * Split user email
     *
     * @param $email
     * @return mixed|string
     */
    public function splitUserEmail($email)
    {
        return explode("@", $email)[0];
    }

    /**
     * Get user token
     *
     * @param $userEmail
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserToken($userEmail)
    {
        $user = User::whereEmail($userEmail)->first();
        $user->token = $user->createToken($userEmail)->accessToken;
        return $user;
    }

    /**
     * Update user package
     *
     * @param $userId
     * @param $packageId
     * @return int
     */
    public function updatePackage($userId, $packageId)
    {
        return DB::table("users")
            ->where('id', $userId)
            ->update(['package_id' => $packageId]);
    }

    /**
     * Count total user
     *
     * @return int
     */
    public function countTotalUser()
    {
        return DB::table('users')->count();
    }
}
