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
                            <a href="{{ action($menu['action']) }}" class="{!! Request::url()==action($menu['action']) ? 'active' : '' !!}">
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
                                @if(isset($menu['url'])&&Request::getUri()==url($menu['url'])||!isset($menu['url'])&&isset($menu['action'])&&Request::getUri()==action($menu['action']))
                                <li class="active">
                                    <a href="{{ isset($menu['url'])?$menu['url']:action($menu['action']) }}">{{ $menu['title'] }}</a>
                                </li>
                                @else
                                    <li>
                                        <a href="{{ isset($menu['url'])?$menu['url']:action($menu['action']) }}">{{ $menu['title'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>