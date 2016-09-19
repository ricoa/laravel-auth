<div class="panel-body">
    <form class="form-inline" role="form">
        <div class="form-group">
            {!! Form::label('', '分组:') !!}
            {!! Form::text('description', \Request::get("description"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'description','data-express'=>'like']) !!}
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