<?php

namespace Ricoa\Auth\Controllers;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use Response;
use Ricoa\Auth\Criteria\WhereCriteria;
use Ricoa\Auth\Models\Role;
use Ricoa\Auth\Models\RoleUser;
use Ricoa\Auth\Models\User;
use Ricoa\Auth\Repositories\RoleUserRepository;

class RoleUserController extends Controller
{
    /** @var  RoleUserRepository */
    private $roleUserRepository;

    public function __construct(RoleUserRepository $roleUserRepo)
    {
        if(method_exists(parent::class,'__construct')){
            parent::__construct();
        }
        $this->roleUserRepository = $roleUserRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @return Response
     */
    public function index()
    {
        $role_users = $this->roleUserRepository->with(['user','role'])->paginate(30);

        return view('role_user.index')
            ->with('role_users', $role_users);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $users=User::pluck('name','id');
        $roles=Role::pluck('display_name','id');
        return view('role_user.create',compact('users','roles'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        unset($input['_token']);

        $role_user = $this->roleUserRepository->updateOrCreate($input,$input);

        Flash::success('新增成功');

        return redirect(route('roles_users.index'));
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
        $ids=explode('-',$id);

        RoleUser::where(['role_id'=>$ids[0],'user_id'=>$ids[1]])->delete();

        Flash::success('删除成功');

        return redirect(route('roles_users.index'));
    }

}
