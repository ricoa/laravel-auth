<?php

namespace Ricoa\Auth\Controllers;

use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Ricoa\Auth\Requests\CreatePermissionRequest;
use Ricoa\Auth\Requests\UpdatePermissionRequest;
use Ricoa\Auth\Repositories\PermissionRepository;
use Flash;
use Response;

class PermissionController extends Controller
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    public $index_route='permissions.index';
    public $back_url="permissions_back_url";

    public function __construct(PermissionRepository $permissionRepo)
    {
        if(method_exists(parent::class,'__construct')){
            parent::__construct();
        }
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rememberUrl($request);

        $this->permissionRepository->pushCriteria(new RequestCriteria($request))->orderBy('description')->orderBy('display_name');
        $permissions = $this->permissionRepository->paginate(30);

        return view('permissions.index')
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('新增成功');
        return $this->redirectRememberUrl();
    }


    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('找不到页面');
            return $this->redirectRememberUrl();
        }

        return view('permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param  int              $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('找不到页面');
            return $this->redirectRememberUrl();
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('编辑成功');
        return $this->redirectRememberUrl();
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('找不到页面');
            return $this->redirectRememberUrl();
        }

        $this->permissionRepository->delete($id);

        Flash::success('删除成功');
        return $this->redirectRememberUrl();
    }
}
