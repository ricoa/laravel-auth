<?php echo '<?php' ?>

use Illuminate\Database\Seeder;
use Ricoa\Auth\Models\Permission;
use Ricoa\Auth\Models\Role;

class RicoaUsersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        //创建超级管理员角色
        $admin = new Role();
        $admin->name         = 'super';
        $admin->display_name = '超级管理员'; // optional
        $admin->description  = '系统超级管理员'; // optional
        $admin->save();

        //创建后台首页权限
        $permission = new Permission();
        $permission->name         = 'AdminController@index';
        $permission->display_name = '【1】后台首页'; // optional
        $permission->description  = '【1】首页'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        //新建用户
        $user=\Ricoa\Auth\Models\User::create([
            'email'=>"1@qq.com",
            'name'=>'超级管理员',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("super");
    }
}
