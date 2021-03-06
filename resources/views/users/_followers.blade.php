{{-- 关注列表 --}}
<div class="card" style="margin-top: 25px;">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" ><a href="{{ route('users.show', $user->id) }}" style="color:#00acd6">个人中心</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if ($tag == 'followers')
                        关注TA的人
                    @elseif($tag == 'following')
                        TA关注的人
                    @endif</li>
            </ol>
        </nav>


        @if (count($followers))
            <ul class="list-group list-group-flush">
                @foreach ($followers as $follower)
                    <li class="list-group-item">
                        <a href="{{route('users.show', $follower->id)}}">
                            <span class="user-avatar pull-left">
                                <img src="{{config('app.url').$follower->avatar}}" class="img-responsive rounded-circle" width="30px" height="30px">
                            </span>
                            <span style="margin-left: 5px">
                            {{ $follower->name }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

        @else
            <div class="empty-block">暂无数据 ~_~ </div>
        @endif

    </div>
</div>