<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
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
     * Controller index function
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->packageRepository->getAll(config('const.paginate'), 'DESC');
    }

    /**
     * Check package function
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function checkUserPackage(Request $request)
    {
        $package = $this->packageRepository->checkExitsPackage($request->id);
        if(empty($package)) {
            return app()->make(ResponseHelper::class)->notFound(trans("auth.admin.empty"));
        } else {
            return app()->make(ResponseHelper::class)->success($package);
        }
    }

    /**
     * Get all package
     *
     * @param Request $request
     * @return \App\Helpers\JsonResponse
     */
    public function getAllPackage(Request $request)
    {
        $package = $this->packageRepository->listAll();
        if(empty($package)) {
            return app()->make(ResponseHelper::class)->notFound(trans("auth.admin.empty"));
        } else {
            return app()->make(ResponseHelper::class)->success($package);
        }
    }
}
