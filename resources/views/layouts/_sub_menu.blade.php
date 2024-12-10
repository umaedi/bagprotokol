@foreach($menu as $me)
    @if(!isset($me['role']) || in_array($user['level'], explode('|',$me['role'])))
    @if(count($me['sub']) == 0)
    <a class="dropdown-item @if(request()->is($me['url'].'*')) active @endif" href="{{ url($me['url']) }}" >
        {!! $me['icon'] !!} {{ $me['name'] }}
    </a>
    @else
    <div class="dropend">
        <a class="dropdown-item dropdown-toggle @if(request()->is($me['url'].'*')) active @endif" href="{{ url($me['url']) }}" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
            {!! $me['icon'] !!} {{ $me['name'] }}
        </a>
        <div class="dropdown-menu">
            @include('layouts._sub_menu', ['menu' => $me['sub']])
        </div>
    </div>
    @endif
    @endif
@endforeach
