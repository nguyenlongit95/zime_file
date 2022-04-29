<?php

namespace App\Http\Controllers\user;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Json;

class FileController extends Controller
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
     * View user's file manage
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fileManage(Request $request)
    {
        $userId = Auth::user()->id;
        $files = $this->fileRepository->getAllUserFile($userId, config('const.paginate'), 'DESC');
        return view('user.file', compact('files'));
    }

    /**
     * View file detail
     *
     * @param Request $request
     * @param $id
     * @return JSON
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function showFileDetail(Request $request, $id)
    {
        $file = $this->fileRepository->find($id);
        if(empty($file)) {
            return app()->make(ResponseHelper::class)->notFound();
        }
        return app()->make(ResponseHelper::class)->success($file);
    }

    /**
     * Delete file
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function deleteFile(Request $request, $id)
    {
        $file = $this->fileRepository->find($id);
        if(empty($file)) {
            return redirect("/file-manage");
        }
        try {
            $folderName = $this->userRepository->splitUserEmail(Auth::user()->email);
            $filePath = "app/" . $folderName . "/" . $file->name;
            if(file_exists(storage_path($filePath))) {
                unlink(storage_path($filePath));
            }
            $this->fileRepository->delete($id);
            return redirect("/file-manage");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Upload new file
     *
     * @param Request $request
     * @return void
     */
    public function uploadFile(Request $request)
    {
        if(!$request->hasFile("file")) {
            return redirect("/file-manage")->with('failed', trans("auth.file.empty"));
        }
        $file = $request->file("file");

        if(substr($file->getClientOriginalName(), -4) !== '.zip') {
            return redirect("/file-manage")->with('failed', trans("auth.file.failed.error"));
        }
        $fileSize = filesize($file);
        $fileName = $file->getClientOriginalName();
        $package = $this->packageRepository->find(Auth::user()->package_id);
        if($fileSize > $package->max_file_size) {
            return redirect("/file-manage")->with('failed', trans("auth.file.failed.size"));
        } else if ($this->fileRepository->getTotalUserFile(Auth::user()->id) == $package->max_file_upload) {
            return redirect("/file-manage")->with('failed', trans("auth.file.failed.full"));
        }

        try {
            $folderName = $this->userRepository->splitUserEmail(Auth::user()->email);
            $file->move(storage_path("app/" . $folderName . "/"), $file->getClientOriginalName());
            $this->fileRepository->uploadFile(Auth::user()->id, $fileName, $fileSize);
            return redirect("/file-manage")->with('success', trans("auth.file.success"));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
