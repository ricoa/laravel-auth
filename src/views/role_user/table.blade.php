<table class="table table-responsive" id="roles-table">
    <thead>
        <th>用户</th>
        <th>角色</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($role_users as $role_user)
        <tr>
            <td>{!! $role_user->user->name !!}</td>
            <td>{!! $role_user->role->display_name !!}</td>
            <td>
                @if(!in_array($role_user->role->name,['admin','super']))
                {!! Form::open(['route' => ['roles_users.destroy',$role_user->role_id."-".$role_user->user_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
                @else
                    不可修改
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>