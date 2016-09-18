
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户:') !!}
    {!! Form::select('user_id',$users, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('role_id', '角色:') !!}
    {!! Form::select('role_id',$roles, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles_users.index') !!}" class="btn btn-default">取消</a>
</div>
