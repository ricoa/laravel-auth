<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            @foreach($menus as $menu)
                @if(isset($menu['action']))
                    @if(isset($menu['url']))
                        <li>
                            <a href="{{ $menu['url'] }}">
                                <span class="title">{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ action($menu['action']) }}" class="{!! Request::url("admin")==action($menu['action']) ? 'active' : '' !!}">
                                <span class="title">{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @elseif(isset($menu['sub']))
                    <li class="sub-menu dcjq-parent-li">
                        <a href="javascript:;" class="dcjq-parent {!! Request::is($menu['active']) ? 'active' : '' !!}">
                            <span>{{ $menu['title'] }}</span>
                            <span class="dcjq-icon"></span></a>
                        <ul class="sub" style="display: none;">
                            @foreach($menu['sub'] as $menu)
                                <li class="{!! isset($menu['action'])?(Request::url("admin")==action($menu['action']) ? 'active' : ''):'' !!}"><a href="{{ isset($menu['url'])?$menu['url']:action($menu['action']) }}">{{ $menu['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
