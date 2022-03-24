<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function config;

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
        $data =  $this->packageRepository->getAll(config('const.paginate'), 'ASC');
        return view("admin.pages.packages.index", compact('data'));
    }

    /**
     * New package form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createForm(Request $request)
    {
        return view("admin.pages.packages.add");
    }

    /**
     * Process package form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Validation::packageValidation($request);
        $data = $request->all();
        try{
            $this->packageRepository->create($data);
            return redirect('/admin/packages')->with('success', trans("auth.admin.create.success"));
        } catch (\Exception $exception) {
            return redirect('admin/packages/add')->with('failed', trans("auth.admin.create.failed"));
        }
    }

    /**
     * Edit package form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editForm($id)
    {
        $package = $this->packageRepository->find($id);
        return view('admin.pages.packages.edit', ['package' => $package]);
    }

    /**
     * Process package update
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $package = $this->packageRepository->find($id);
        if(empty($package)){
            return redirect()->back()->with('failed');
        }
        try{
            $this->packageRepository->update($data, $package->id);
            return redirect()->back()->with('success', trans("auth.admin.update.success"));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect('admin/packages')->with('failed', trans("auth.admin.update.failed"));
        }
    }
}
