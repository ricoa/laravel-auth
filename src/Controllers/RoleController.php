<?php

namespace Ricoa\Auth\Controllers;

use App\Criteria\WhereInCriteria;
use App\Http\Controllers\Controller;
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
    public function index()
    {
        $roles = $this->roleRepository->paginate(30);

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

        return redirect(route('roles.index'));
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

            return redirect(route('roles.index'));
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

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        Flash::success('编辑成功');

        return redirect(route('roles.index'));
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

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('roles.index'));
    }


    public function permissions($id,PermissionRepository $permissionRepository)
    {

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('找不到页面');

            return redirect(route('roles.index'));
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

            return redirect(route('roles.index'));
        }

        $ids=\Request::get('permissions',[]);

        $permissions = $permissionRepository->pushCriteria(new WhereInCriteria('id',$ids))->all();

        DB::table('permission_role')->where('role_id',$role->id)->delete();

        if(!$permissions->isEmpty()){
            $role->attachPermissions($permissions);
        }

        Flash::success('编辑成功');

        return redirect(route('roles.index'));
    }
}
