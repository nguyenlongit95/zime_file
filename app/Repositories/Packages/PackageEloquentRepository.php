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

    /**
     * Count total package
     *
     * @return int
     */
    public function countTotalPackage()
    {
        return DB::table('packages')->count();
    }

    /**
     * Get package name
     *
     * @param $packageId
     * @return mixed
     */
    public function getPackageName($packageId)
    {
        $package = DB::table("packages")->where("id",  $packageId)->first();
        return $package->name;
    }
    /**
     * Get total user who is using package by package id
     *
     * @param $packageId
     * @return int
     */
    public function getTotalUser($packageId)
    {
        return DB::table("users")->where("package_id", $packageId)->count();
    }
}
