<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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
     * Controller index function
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = $this->userRepository->getUsers(config('const.paginate'), 'ASC');
        return view("admin.pages.users.index", compact('data'));
    }

    /**
     * View detail user function
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $user = $this->userRepository->find($id);
        if(empty($user)) {
            return redirect()->back()->with("failed", trans("auth.admin.empty"));
        }
        $files = $this->fileRepository->getAllUserFile($user->id, config('const.paginate'), 'ASC');
        $totalFile = $this->fileRepository->getTotalUserFile($user->id);
        $lastTimeFile = $this->fileRepository->getLastTimeUpload($user->id);
        $package = $this->packageRepository->find($user->package_id);
        return view("admin.pages.users.view", compact(
            'user',
            'files',
            'totalFile',
            'package',
            'lastTimeFile',
        ));
    }

    /**
     * Update user function
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Validation::userValidation($request);
        $user = $this->userRepository->find($id);
        if(empty($user)) {
            return redirect()->back()->with('failed', trans("auth.admin.empty"));
        }
        $data = $request->all();
        if(!is_null($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        try {
            $this->userRepository->update($data, $user->id);
            return redirect("/admin/users")->with('success', trans("auth.admin.update.success"));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('failed', trans("auth.admin.update.failed"));
        }
    }

    public function destroy(Request $request)
    {
        $user = $this->userRepository->find($request->id);
        if(empty($user)) {
            return redirect()->back()->with("failed", trans("auth.admin.empty"));
        }
        try {
            $this->userRepository->delete($user->id);
            return redirect()->back()->with("success", trans("auth.admin.delete.success1"));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with("failed", trans("auth.admin.delete.failed"));
        }
    }
}
