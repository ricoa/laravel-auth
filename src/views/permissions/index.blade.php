@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    权限
                    <a class="btn btn-primary pull-right" href="{!! route('permissions.create') !!}">新增</a>
                    <br><br>
                </header>
                <div class="panel-body">
                   @include('flash::message')
                   @include('permissions.table')
                    {!! $permissions->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

