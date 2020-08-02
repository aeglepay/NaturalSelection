<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            @foreach(menus() as $menu)
            <li class="menu">
                <a href="{{ property_exists($menu, 'children') ? "#{$menu->id}" : url($menu->link) }}" data-active="{{ request()->is($menu->link) ? 'true' : 'false' }}" @if(property_exists($menu, 'children' )) data-toggle="collapse" aria-expanded="{{ request()->is($menu->link) ? 'true' : 'false' }}" @endif class="dropdown-toggle">
                    <div class="">
                        <i data-feather="{{ $menu->icon }}"></i>
                        <span>{{ $menu->name }}</span>
                    </div>
                    @if(property_exists($menu, 'children'))
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    @endif
                </a>
                @if(property_exists($menu, 'children'))
                <ul class="collapse submenu list-unstyled {{ request()->is($menu->link) ? 'show' : 'hide' }}" id="{{ $menu->id }}" data-parent="#accordionExample">
                    @foreach($menu->children as $menu)
                    <li>
                        <a href="{{ url($menu->link) }}" class="{{ request()->is($menu->link) ? 'active' : null }}">
                            {{ $menu->name }}
                        </a>
                        @if(property_exists($menu, 'children'))
                        <ul>
                            @foreach($menu->children as $menu)
                            @if(has_roles($menu->roles))
                            <li>
                                <a href="{{ url($menu->link) }}" class="{{ request()->is($menu->link) ? 'active' : null }}">
                                    {{ $menu->name }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach

        </ul>
        <!-- <div class="shadow-bottom"></div> -->

    </nav>

</div>
<!--  END SIDEBAR  -->
