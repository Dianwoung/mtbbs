@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        作者：{{ $topic->user->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('users.show', $topic->user->id) }}">
                                <img class="img-thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">
                        {{ $topic->title }}
                    </h1>

                    <div class="article-meta text-right">
                        {{ $topic->created_at->diffForHumans() }}
                        <span> • </span>
                        <i class="material-icons">comment</i>
                        {{ $topic->reply_count }}
                        <span> • </span>
                        <i class="material-icons">visibility</i>
                        {{ $topic->view_count }}
                    </div>

                    <div class="topic-body" style="margin-top: 15px">
                       <mavon-editor value='{{ $topic->body }}'
                                     :toolbars-flag="t_status"
                                     :subfield="t_status"
                                     :editable="t_status"
                                     :scroll-style="t_status"
                                     :default-open="t_pre"
                                        style="height: 100%;"></mavon-editor>
                    </div>

                    @can('update', $topic)
                        <div class="operate">
                            <hr>
                            <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-info btn-xs pull-left" role="button">
                                <i class="material-icons">mode_edit</i> 编辑
                            </a>

                            <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs pull-left" style="margin-left: 6px">
                                    <i class="material-icons">delete</i>
                                    删除
                                </button>
                            </form>
                        </div>
                    @endcan

                </div>
            </div>

            {{-- 用户回复列表 --}}
            <div class="card card-default topic-reply">
                <div class="card-body">
                    @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
                    @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->orderBy('id','desc')->get()])
                </div>
            </div>
        </div>
    </div>
@stop