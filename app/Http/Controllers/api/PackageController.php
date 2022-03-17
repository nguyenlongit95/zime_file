<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Packages\PackageRepositoryInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * @var PackageRepositoryInterface
     */
    protected $packageRepository;

    /**
     * PackageController constructor
     * @param PackageRepositoryInterface $packageRepository
     */
    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->packageRepository->getAll(config('const.paginate'), 'DESC');
    }
}
