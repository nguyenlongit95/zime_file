<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageRepositoryInterface;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @var PackageRepositoryInterface
     * @var FileRepositoryInterface
     */
    protected $fileRepository;
    protected $packageRepository;

    /**
     * Constructor
     * @param PackageRepositoryInterface $packageRepository
     * @param FileRepositoryInterface $fileRepository
     */
    public function __construct(FileRepositoryInterface $fileRepository, PackageRepositoryInterface  $packageRepository)
    {
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
        return $this->fileRepository->getAll(config('const.paginate'), 'DESC');
    }

    /**
     * Show all user's file
     *
     * @param Request $request
     * @return void
     */
    public function showFile(Request $request)
    {
        $file = $this->fileRepository->getAllUserFile($request->id, config('const.paginate'), 'DESC');
        if(empty($file)) {
            return ResponseHelper::notFound(trans("auth.admin.empty"));
        } else {
            return ResponseHelper::success($file);
        }
    }

    /**
     * Show detail one user's file
     *
     * @param Request $request
     * @return \App\Helpers\JsonResponse
     */
    public function showDetailFile(Request $request)
    {
        $file = $this->fileRepository->showDetailFile($request->id);
        if(empty($file)) {
            return ResponseHelper::notFound(trans("auth.admin.empty"));
        } else {
            return ResponseHelper::success($file);
        }
    }

    /**
     * Delete user's file
     *
     * @param Request $request
     * @return \App\Helpers\JsonResponse
     */
    public function deleteUserFile(Request $request)
    {
        $file = $this->fileRepository->deleteFile($request->id);
        if(empty($file)) {
            return ResponseHelper::notFound(trans("auth.admin.empty"));
        } else {
            return ResponseHelper::success($file);
        }
    }

    /**
     * Upload user's file
     *
     * @param Request $request
     * @return \App\Helpers\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        $maxSize = $this->packageRepository->checkExitsPackage($request->id)->max_file_size;
        $userFileSize = $request->file($request->name)->getSize();
        if($userFileSize > $maxSize) {
            return ResponseHelper::error();
        } else {
            $file = $this->fileRepository->uploadFile($request->id, $request->name, $userFileSize);
            return ResponseHelper::success($file);
        }
    }
}
