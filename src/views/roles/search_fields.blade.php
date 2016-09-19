<div class="panel-body">
    <form class="form-inline" role="form">
        <div class="form-group">
            {!! Form::label('', '角色名:') !!}
            {!! Form::text('display_name', \Request::get("display_name"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'display_name','data-express'=>'like']) !!}
        </div>

        <input type="hidden" name="search">
        <input type="hidden" name="searchFields">
        <button type="button" class="btn btn-success" data-role="search">搜索</button>
    </form>
</div>

@section('scripts')
    @parent
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection