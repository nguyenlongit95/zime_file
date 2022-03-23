<?php


namespace App\Repositories\Users;


interface UserRepositoryInterface
{
    public function checkRole($userId);
}
