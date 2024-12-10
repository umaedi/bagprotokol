<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    @foreach(config('menu.main') as $mn)
                        @if(!isset($mn['role']) || in_array($user['level'], explode('|',$mn['role'])))
                        @if(count($mn['sub']) == 0)

                    <li class="nav-item @if(request()->is($mn['url'].'*')) active @endif">
                        <a class="nav-link" href="{{ url($mn['url']) }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      {!! $mn['icon'] !!}
                    </span>
                            <span class="nav-link-title">
                      {{ $mn['name'] }}
                    </span>
                        </a>
                    </li>

                        @else
                    <li class="nav-item dropdown @if(request()->is($mn['url'].'*')) active @endif">
                        <a class="nav-link dropdown-toggle" href="{{ url($mn['url']) }}" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $mn['icon'] !!}
                    </span>
                            <span class="nav-link-title">
                      {{ $mn['name'] }}
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    @include('layouts._sub_menu', ['menu' => $mn['sub']])
                                </div>
                            </div>
                        </div>
                    </li>

                        @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
