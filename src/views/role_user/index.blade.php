@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    用户角色
                    <a class="btn btn-primary pull-right" href="{!! route('roles_users.create') !!}">新增</a>
                    <br><br>
                </header>
                <div class="panel-body">
                   @include('flash::message')
                   @include('role_user.table')
                   {!! $role_users->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

