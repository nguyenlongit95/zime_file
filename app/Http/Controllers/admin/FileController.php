<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Files\FileRepositoryInterface;
use Illuminate\Http\Request;
use function config;

class FileController extends Controller
{
    /**
     * @var FileRepositoryInterface
     */
    protected $fileRepository;

    /**
     * FileController constructor
     * @param FileRepositoryInterface $fileRepository
     */
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
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
}
