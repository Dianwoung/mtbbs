<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            MTBBS
        </a>

        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler my-2 my-sm-0" type="button" data-toggle="collapse"
                data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <ul class="mr-auto mt-2 mt-lg-0 nav">
                <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link"
                                                                                     href="{{ route('topics.index') }}">话题</a>
                </li>
                @foreach($categories as $key => $category)
                    <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category', $category->id))) }}">
                        <a class="nav-link"
                           href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
            <ul class="mr-auto mt-2 mt-lg-0 nav">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search') }}">
                        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search"
                               aria-label="Search" required>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            <ul class="mr-auto mt-2 mt-lg-0 nav">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login')  }}">登录</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('topics.create') }}">
                            <i class="material-icons">add</i>
                        </a>
                    </li>
                    {{-- 消息通知标记 --}}
                    <li class="nav-item notifications-badge">
                        <a href="{{ route('notifications.index') }}" class="nav-link">
                            <span class="badge badge-pill badge-info badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} "
                                  title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left">
                                <img src="{{config('app.url').Auth::user()->avatar}}"
                                     class="img-responsive rounded-circle" width="30px" height="30px">
                            </span>
                            <span style="margin-left: 5px">{{ Auth::user()->name }}</span> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                    @can('manage_contents')
                            <a class="dropdown-item" href="{{ route('admin::home')}}">
                                <i class="material-icons">dashboard</i>
                                管理后台
                            </a>
                    @endcan
                    <a class="dropdown-item" href="{{ route('users.show',Auth::id()) }}">
                        <i class="material-icons">perm_identity</i>个人中心
                    </a>
                    <a class="dropdown-item" href="{{ route('users.edit',Auth::id()) }}">
                        <i class="material-icons">edit</i>编辑资料
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>退出登录
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
        </div>
        </li>
        @endguest
        </ul>


    </div>
    </div>

</nav>