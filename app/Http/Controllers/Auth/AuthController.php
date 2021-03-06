<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AuthController constructor
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show user login form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login_form()
    {
        return view('auth.user.login');
    }

    /**
     * Process user login form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function process_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user_data = array(
            'email' => $request->get("email"),
            'password' => $request->get("password"),
        );

        if(Auth::attempt($user_data)) {
            // Todo return token
            return redirect('/home');
        } else {
            return back()->with("error", trans("auth.login_failed"));
        }
    }

    /**
     * Show signup form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function signup_form()
    {
        return view('auth.user.signup');
    }

    /**
     * Process signup form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function process_signup(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('signup')
            ->withInput()
            ->withErrors($validator);
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            try{
                $this->userRepository->create($data);
                return redirect('login')->with('status', trans("auth.signup_success"));
            } catch (\Exception $exception) {
                return redirect('signup')->with('status', trans("auth.signup_failed"));
            }
        }
    }

    /**
     * Admin login form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminLogin()
    {
        return view('auth.admin.login');
    }

    /**
     * Process admin login form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function process_adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user_data = array(
            'email' => $request->get("email"),
            'password' => $request->get("password"),
        );

        if(Auth::attempt($user_data)) {
            return redirect('/admin/dashboard');
        } else {
            return back()->with("error", trans("auth.login_failed"));
        }
    }
}
