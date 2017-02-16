<table class="table table-responsive" id="permissions-table">
    <thead>
    <th>控制器方法</th>
    <th>分组</th>
    <th>显示名字</th>
    <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{!! $permission->name !!}</td>
            <td>{!! $permission->description !!}</td>
            <td>{!! $permission->display_name !!}</td>
            <td>
                {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @if(can(\Auth::user(),'\Ricoa\Auth\Controllers\PermissionController@edit'))
                    <a href="{!! route('permissions.edit', [$permission->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    @endif

                    @if(can(\Auth::user(),'\Ricoa\Auth\Controllers\PermissionController@destroy'))
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>',
                        ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>