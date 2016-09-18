@extends('layouts.app')
@section('description',$post->description)
@section('title',$post->title)
{{--@section('css')
    <link href="//cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-heath.light.min.css" rel="stylesheet">
@endsection--}}
@section('content')
    <div class="row">
        <div class="post-detail">
            @can('update',$post)
                <div class="btn-group pull-right" style="margin-top: -25px">
                    <a class="btn" href="{{ route('post.edit',$post->id) }}"><i class="fa fa-pencil"></i></a>
                    <a class="btn" role="button" data-toggle="modal" data-target="#delete-post-modal">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>
                @include('post.delete-modal',$post)
            @endcan
            <div class="center-block">
                <h2>{{ $post->title }}</h2>
                <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00" content="2016-08-05">
                           {{ $post->published_at==null?'Un Published':$post->published_at->format('Y-m-d H:i') }}
                           </time>
                           </span>
                    <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <a href="{{ route('category.show',$post->category->name) }}">
                           {{ $post->category->name }}
                           </a>
                           </span>
                    {{--<span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comment-o" aria-hidden="true"></i>
                           <span>7条评论</span>
                           </span>--}}
                    <span>
                           &nbsp;|&nbsp;
                           <i class="fa fa-eye"></i>
                           <span>{{ $post->view_count }}</span>
                           </span>
                </div>
            </div>
            <br>
            <div class="post-content">
                {!! $post->html_content !!}
            </div>
            <div class="tag-list">
                <i class="fa fa-tags"></i>
                @foreach($post->tags as $tag)
                    <a class="tag" href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="widget widget-default">
            <div class="widget-header">
                评论
            </div>
            <div class="widget-body">
                @forelse($comments as $comment)
                    <div class="" style="margin: 10px 0 25px 0">
                        <div class="pull-left">
                            <a href="/">
                                <img width="50px" height="50px" class="img-circle"
                                     src="https://avatars1.githubusercontent.com/u/20706332">
                            </a>
                        </div>
                        <div class="comment-info" style="margin-left: 66px">
                            <div class="">
                                <span>{{ $comment->user->name }}</span>
                                <span>{{ $comment->created_at->format('y-m-d H:m') }}</span>
                            </div>
                            <div>
                                <p>{!! $comment->html_content !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="alone-divider"></div>
                @empty
                @endforelse

                <form method="post" action="{{ route('comment.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <label for="comment-content">评论内容</label>
                    <textarea placeholder="支持Markdown" style="resize: vertical" id="comment-content" name="content"
                              rows="5" spellcheck="false" class="form-control  autosize-target"></textarea>
                    <button style="margin-top: 10px" type="submit" class="btn btn-primary">回复</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection