<p align="center">
laravel-auth
</a>

<p align="center">一个基于Laravel的后台权限、菜单管理解决方案.</p>

## 描述
本系统集laravel的后台权限管理和菜单管理于一体，使得开发者不用过多关注权限和菜单如何处理，可以花更多时间去考虑如何更好完成项目。

本系统使用[Zizaco/entrust](https://github.com/Zizaco/entrust)做为权限的基础，请先阅读相关文档，理解其中的概念。

## 安装
```
//安装开发中版本
composer require ricoa/laravel-auth:dev-master
```

## 配置
1、注册 ServiceProvider:
```
\Ricoa\Auth\MenusServiceProvider::class,
```

2、创建配置文件
```
php artisan vendor:publish
```

3、修改config/menus.php的对应信息

4、添加数据
在database/seeds/DatabaseSeeder.php里添加
```
$this->call(RicoaUsersSeeder::class);
```
此时会生成

* 超级管理员角色
```
[
	'name'=> 'super',
	'display_name'=> '超级管理员',
	'description'=> '系统超级管理员',
]
```

* 用户,角色是超级管理员
```
[
	'email'=>"1@qq.com",
	'name'=>'超级管理员',
	'password'=>'1',
]
```
* 基础权限

## 使用
