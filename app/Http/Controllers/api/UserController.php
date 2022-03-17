<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Controller index function
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        Validation::userValidation($request);
        return $this->userRepository->getAll(config('const.paginate'), 'DESC');
    }
}
