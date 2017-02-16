<?php echo '<?php' ?>

use Illuminate\Database\Seeder;
use Ricoa\Auth\Models\Permission;
use Ricoa\Auth\Models\Role;

class RicoaUsersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return  void
    */
    public function run()
    {
        //创建超级管理员角色
        $admin = new Role();
        $admin->name         = 'super';
        $admin->display_name = '超级管理员'; // optional
        $admin->description  = '系统超级管理员'; // optional
        $admin->save();

        //新建用户
        $user=\Ricoa\Auth\Models\User::create([
            'email'=>"1@qq.com",
            'name'=>'超级管理员',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("super");

        //创建后台权限
        $this->createPermission($admin);
    }


    public function createPermission(Role $admin)
    {
        $permission = new Permission();
        $permission->name         = 'AdminController@index';
        $permission->display_name = '【1】后台首页'; // optional
        $permission->description  = '【1】首页'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        /**
         * 权限
         */
        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\PermissionController@index';
        $permission->display_name = '【1】权限列表'; // optional
        $permission->description  = '【2】权限'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\PermissionController@create-store';
        $permission->display_name = '【2】权限创建'; // optional
        $permission->description  = '【2】权限'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\PermissionController@edit-update';
        $permission->display_name = '【3】权限编辑'; // optional
        $permission->description  = '【2】权限'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\PermissionController@destroy';
        $permission->display_name = '【4】权限删除'; // optional
        $permission->description  = '【2】权限'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        /**
         * 角色
         */
        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleController@index';
        $permission->display_name = '【1】角色列表'; // optional
        $permission->description  = '【3】角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleController@create-store';
        $permission->display_name = '【2】角色创建'; // optional
        $permission->description  = '【3】角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleController@edit-update';
        $permission->display_name = '【3】角色编辑'; // optional
        $permission->description  = '【3】角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleController@destroy';
        $permission->display_name = '【4】角色删除'; // optional
        $permission->description  = '【3】角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleController@permissions-permissionsUpdate';
        $permission->display_name = '【5】角色权限分配'; // optional
        $permission->description  = '【3】角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);


        /**
         * 用户角色分配
         */
        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleUserController@index';
        $permission->display_name = '【1】用户角色列表'; // optional
        $permission->description  = '【4】用户角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleUserController@create-store';
        $permission->display_name = '【2】用户角色创建'; // optional
        $permission->description  = '【4】用户角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleUserController@edit-update';
        $permission->display_name = '【3】用户角色编辑'; // optional
        $permission->description  = '【4】用户角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = '\Ricoa\Auth\Controllers\RoleUserController@destroy';
        $permission->display_name = '【4】用户角色删除'; // optional
        $permission->description  = '【4】用户角色'; // optional
        $permission->save();
        $admin->attachPermission($permission);
    }
}
