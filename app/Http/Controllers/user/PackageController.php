<?php

namespace App\Http\Controllers\user;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
     * Display all package
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function viewPackage(Request $request)
    {
        $package = $this->packageRepository->listAll();
        if(empty($package)) {
            return redirect('login')->with('failed', trans("auth.admin.empty"));
        } else {
            return view('user.package', compact("package"));
        }
    }

    /**
     * Redirect fileManage if package_id exits
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function packageManage(Request $request)
    {
        if(Auth::user()->package_id)
            return redirect('file-manage');
        else
            return redirect('view-package');
    }

    /**
     * User select package
     *
     * @param Request $request
     * @return
     */
    public function selectUserPackage(Request $request)
    {
        $data = $request->all();
        try {
            $this->userRepository->updatePackage(Auth::user()->id, $data["id"]);
            return app()->make(ResponseHelper::class)->success($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
