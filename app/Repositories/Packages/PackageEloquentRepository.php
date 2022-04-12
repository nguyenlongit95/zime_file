<?php

namespace App\Repositories\Packages;

use App\Models\Package;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class PackageEloquentRepository extends EloquentRepository implements PackageRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Package::class;
    }

    /**
     * Check exits user package
     *
     * @param $userId
     * @return array
     */
    public function checkExitsPackage($userId)
    {
        $packageId =  DB::table("users")->where("id", $userId)->first()->package_id;
        if(isset($packageId)) {
            return DB::table("packages")->where("id", $packageId)->first();
        } else {
            return [];
        }
    }
}
