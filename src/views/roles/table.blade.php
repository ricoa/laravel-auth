<table class="table table-responsive" id="roles-table">
    <thead>
        <th>英文名</th>
        <th>显示名字</th>
        <th>描述</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{!! $role->name !!}</td>
            <td>{!! $role->display_name !!}</td>
            <td>{!! $role->description !!}</td>
            <td>
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @if(can(\Auth::user(),'\Ricoa\Auth\Controllers\RoleController@permissions'))
                        <a href="{!! route('roles.permissions', [$role->id]) !!}" class='btn btn-success btn-xs'>编辑权限</a>
                    @endif

                    @if(can(\Auth::user(),'\Ricoa\Auth\Controllers\RoleController@edit'))
                        <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    @endif

                    @if(can(\Auth::user(),'\Ricoa\Auth\Controllers\RoleController@destroy'))

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>