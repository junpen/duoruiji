@extends("common.front-layout")
@section("title","往期视频")
@section("content")
    <div class="head">
        <div class="nav">
            <ul class="nav_body">
                <li><a href="/">首页</a></li>
                <li><a href="/conf">名家讲堂</a></li>
                <li><a href="/expert">名家风采</a></li>
                <li><a class="current" href="/review">往期视频</a></li>
            </ul>
        </div>
    </div>
    <div class="main">
    <div class="past_video">
        <div class="past_video_list">
            <div class="one_line clearfix">
                @foreach($lives as $v)
                <div class="review_ship">
                    <div class="index_right_img">
                        <a href="/review-info/{{$v->id}}">
                            <img src="{{$v->portrait}}" />
                        </a>
                    </div>
                    <div class="review_ship_txt">
                        <div class="review_ship_title break"><a href="/review-info/{{$v->id}}">{{$v->title}}</a></div>
                        <div class="review_ship_intro clearfix">
                            <div class="review_ship_left">
                                <p>主持：<a href="/info/{{$v->eid}}">{{$v->associate}}</a></p>
                                <p>日期：<span class="txt_999">{{$v->begin}}</span></p>
                            </div>
                            <div class="review_ship_right">
                                <a class="info_btn" href="/review-info/{{$v->id}}">查看详情</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
            {{$lives->links()}}
    </div>
@endsection
