<?php

namespace Ricoa\Auth\Controllers;

use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Ricoa\Auth\Criteria\WhereInCriteria;
use DB;
use Ricoa\Auth\Requests\CreateRoleRequest;
use Ricoa\Auth\Requests\UpdateRoleRequest;
use Ricoa\Auth\Repositories\PermissionRepository;
use Ricoa\Auth\Repositories\RoleRepository;
use Flash;
use Response;

class RoleController extends Controller
{
    /** @var  RoleRepository */
    private $roleRepository;
    public $index_route='roles.index';
    public $back_url="roles_back_url";

    public function __construct(RoleRepository $roleRepo)
    {
        if(method_exists(parent::class,'__construct')){
            parent::__construct();
        }
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rememberUrl($request);

        $roles = $this->roleRepository->pushCriteria(new RequestCriteria($request))->paginate(30);

        return view('roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        Flash::success('新增成功');

        return $this->redirectRememberUrl();
    }


    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return $this->redirectRememberUrl();
        }

        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return $this->redirectRememberUrl();
        }

        $role = $this->roleRepository->update($request->all(), $id);

        Flash::success('编辑成功');

        return $this->redirectRememberUrl();
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return $this->redirectRememberUrl();
        }

        $this->roleRepository->delete($id);

        Flash::success('删除成功');

        return $this->redirectRememberUrl();
    }


    public function permissions($id,PermissionRepository $permissionRepository)
    {

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return $this->redirectRememberUrl();
        }

        $permissionRepository->orderBy('description')->orderBy('display_name');
        $permissions = $permissionRepository->all();

        $permissions_show=[];
        foreach ($permissions as $key => $permission){
            $permissions_show[$permission['description']][]=$permission;
        }

        $role->permissions=$role->perms()->pluck('id')->toArray();

        return view('roles.permission')->with('role', $role)->with('permissions',$permissions_show);
    }


    public function permissionsUpdate($id,PermissionRepository $permissionRepository)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return $this->redirectRememberUrl();
        }

        $ids=\Request::get('permissions',[]);

        $permissions = $permissionRepository->pushCriteria(new WhereInCriteria('id',$ids))->all();

        DB::table('permission_role')->where('role_id',$role->id)->delete();

        if(!$permissions->isEmpty()){
            $role->attachPermissions($permissions);
        }

        Flash::success('编辑成功');

        return $this->redirectRememberUrl();
    }
}
