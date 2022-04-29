<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @var FileRepositoryInterface
     * @var UserRepositoryInterface
     * @var PackageRepositoryInterface
     */
    protected $userRepository;
    protected $fileRepository;
    protected $packageRepository;

    /**
     * Controller constructor.
     * @param UserRepositoryInterface $userRepository
     * @param FileRepositoryInterface $fileRepository
     * @param PackageRepositoryInterface $packageRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, FileRepositoryInterface $fileRepository, PackageRepositoryInterface $packageRepository)
    {
        $this->userRepository = $userRepository;
        $this->fileRepository = $fileRepository;
        $this->packageRepository = $packageRepository;
    }

    /**
     * View admin dashboard function
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $totalUser = $this->userRepository->countTotalUser();
        $totalFile = $this->fileRepository->countTotalFile();
        $totalPackage = $this->packageRepository->countTotalPackage();
        return view("admin.pages.dashboard", compact(
            'totalUser',
            'totalFile',
            'totalPackage',
        ));
    }

    /**
     * Get data to make dashboard
     *
     * @param Request $request
     * @return void
     */
    public function processDashboard(Request $request){
        $totalPackage = $this->packageRepository->countTotalPackage();
        $data = array();
        for($i = 1; $i <= $totalPackage; $i++) {
            $countUser = $this->packageRepository->getTotalUser($i);
            $packName = $this->packageRepository->getPackageName($i);
            $data += ["package" . $i => [$packName, $countUser]];
        }
        if(empty($data)) {
            return app()->make(ResponseHelper::class)->notFound();
        }
        return app()->make(ResponseHelper::class)->success($data);
    }

    /**
     * Get total file last 7days
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function processDashboard1(Request $request){
        $data = array();
        for($i = 0; $i <= 6; $i++) {
            $time = date('Y-m-d', strtotime('-'. $i. ' days'));
            $totalFile = $this->fileRepository->countTotalFileByDate($time);
            $arr_tmp = [
                'date' =>  date('d/m', strtotime('-'. $i. ' days')),
                'total' => $totalFile,
            ];
            $data[$i] = $arr_tmp;
        }
        return app()->make(ResponseHelper::class)->success($data);
    }

    /**
     * Get total file last 30days
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function processDashboard2(Request $request){
        $data = array();
        for($i = 0; $i <= 29; $i++) {
            $time = date('Y-m-d', strtotime('-'. $i. ' days'));
            $totalFile = $this->fileRepository->countTotalFileByDate($time);
            $arr_tmp = [
                'date' =>  date('d/m', strtotime('-'. $i. ' days')),
                'total' => $totalFile,
            ];
            $data[$i] = $arr_tmp;
        }
        return app()->make(ResponseHelper::class)->success($data);
    }
}
