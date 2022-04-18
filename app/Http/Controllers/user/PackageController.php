<?php

namespace App\Http\Controllers\user;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
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
     * Select package page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selectPackage(Request $request)
    {
        $package = $this->packageRepository->listAll();
        if(empty($package)) {
            return redirect('login')->with('failed', trans("auth.admin.empty"));
        } else {
            return view('user.package', compact("package"));
        }
    }
}
