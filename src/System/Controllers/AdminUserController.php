<?php

namespace LeadStore\Framework\System\Controllers;

use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use LeadStore\Framework\Models\Database\AdminUser as Model;
use LeadStore\Framework\System\DataGrid\AdminUserDataGrid;
use LeadStore\Framework\Image\Facades\ImageManager;
use LeadStore\Framework\User\Requests\AdminUserRequest;
use LeadStore\Framework\Models\Contracts\AdminUserInterface;
use LeadStore\Framework\Models\Database\AdminUser;

class AdminUserController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\AdminUserRepository
     */
    protected $repository;

    public function __construct(AdminUserInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUserGrid = new AdminUserDataGrid($this->repository->query());

        return view('avored-framework::system.admin-user.index')->with('dataGrid', $adminUserGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LeadStore\Framework\Http\Requests\AdminUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->get('password'))]);

        $this->repository->create($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \LeadStore\Framework\Models\Database\AdminUser $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $adminUser)
    {
        return view('avored-framework::system.admin-user.edit')
                    ->with('model', $adminUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LeadStore\Framework\Http\Requests\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, Model $adminUser)
    {
        if (null !== $request->file('image')) {
            $path = $this->_getUserImageRelativePath();
            $image = ImageManager::upload($request->file('image'), $path)->makeSizes()->get();

            $request->merge(['image_path' => $image->relativePath]);
        }

        $adminUser->update($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $adminUser)
    {
        $adminUser->delete();
        return redirect()->route('admin.admin-user.index');
    }

    public function apiShow()
    {
        $user = Auth::guard('admin')->user();
        $client = Client::wherePasswordClient(1)->whereUserId($user->id)->first();

        return view('avored-framework::system.admin-user.show-api')->with('client', $client);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail()
    {
        $user = Auth::guard('admin')->user();

        return view('avored-framework::system.admin-user.detail')->with('user', $user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        return view('avored-framework::system.admin-user.show')->with('user', $adminUser);
    }

    private function _getUserImageRelativePath()
    {
        $tmpPath = str_split(strtolower(str_random(3)));
        return '/uploads/users/images/' . implode('/', $tmpPath);
    }
}
