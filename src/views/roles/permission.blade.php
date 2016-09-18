@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    角色权限
                </header>
                <div class="panel-body">
                   @include('flash::message')
                    <form class="form-horizontal tasi-form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">***顶级分类***</label>
                            <div class="col-lg-10">
                                <label class="checkbox-inline">
                                    ***次级分类***
                                </label>
                            </div>
                        </div>
                        @foreach($permissions as $key => $permission)
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2" for="{{ $key }}">
                                    <input type="checkbox" id="{{ $key }}" data-role="select-all">
                                    {{ $key }}
                                </label>
                                <div class="col-lg-10">
                                    @foreach($permission as $per)
                                        <label class="checkbox-inline" for="{{ $per->name }}">
                                            <input type="checkbox" id="{{ $per->name }}" value="{{ $per->id }}" name="permissions[]" data-item="{{ $key }}" {{ in_array($per->id,$role->permissions)?"checked":"" }}>
                                            {{ $per->display_name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('roles.index') !!}" class="btn btn-default">取消</a>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        $(function(){
            $("[data-role=select-all]").click(function(){
                var item=$(this).attr("id");

                var checked=$(this).is(':checked');

                $("[data-item="+item+"]").each(function(){
                    $(this).prop("checked",checked);
                });

            });
        })
    </script>
@endsection
