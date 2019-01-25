<?php

namespace LeadStore\Framework\User\Controllers;

use LeadStore\Framework\Models\Database\UserGroup;
use LeadStore\Framework\Models\Contracts\UserGroupInterface;
use LeadStore\Framework\System\Controllers\Controller;
use LeadStore\Framework\User\DataGrid\UserGroupDataGrid;
use LeadStore\Framework\User\Requests\UserGroupRequest;

class UserGroupController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\UserGroupRepository
     */
    protected $repository;

    public function __construct(UserGroupInterface $repository)
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
        $dataGrid = new UserGroupDataGrid($this->repository->query());

        return view('avored-framework::user.user-group.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::user.user-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LeadStore\Framework\Http\Requests\AdminUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupRequest $request)
    {
        $this->_syncIsDefault();
        $this->repository->create($request->all());

        return redirect()->route('admin.user-group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \LeadStore\Framework\Models\Database\UserGroup $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGroup $userGroup)
    {
        return view('avored-framework::user.user-group.edit')
                    ->with('model', $userGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LeadStore\Framework\Http\Requests\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupRequest $request, UserGroup $userGroup)
    {
        $this->_syncIsDefault();

        $userGroup->update($request->all());

        return redirect()->route('admin.user-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();
        return redirect()->route('admin.user-group.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(UserGroup $userGroup)
    {
        return view('avored-framework::user.user-group.show')->with('userGroup', $userGroup);
    }

    private function _syncIsDefault()
    {
        $model = $this->repository->query()->whereIsDefault(1)->first();

        if (null !== $model) {
            $model->update(['is_default' => 1]);
        }
    }
}
