@extends("common.front-layout")
@section("title","名家风采-详情")
@section("content")
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/conf">名家讲堂</a></li>
            <li><a class="current" href="/expert">名家风采</a></li>
            <li><a href="/review">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="export_info">
        <div class="export_this">
            <div class="title_box">本期嘉宾</div>
            <div class="export_this_body clearfix">
                <div class="left_export"><img src="{{$expert->portrait}}" /></div>
                <div class="right_export">
                    <div class="export_base">
                        <p class="name">{{$expert->username}} {{$expert->title}}</p>
                        <p><b>科室：</b>{{$expert->department}}</p>
                        <p><b>职称：</b>{{$expert->post}}</p>
                    </div>
                    <div class="export_this_intro">
                        <div class="export_edu clearfix">
                            <div class="edu_title">接受教育：</div>
                            <div class="edu_info">
                                <p>{{$expert->education}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="this_intro">
            <div class="title_box">本期简介</div>
            <div class="this_intro_body">
                <p class="te_2">{{$expert->introduction}}</p>
            </div>
        </div>
        @if($otherExperts)
            <div class="other_export">
                <div class="title_box">其他专家</div>
                <div class="export_list clearfix">
                    @foreach( $otherExperts as $k=>$v)
                        <div class="export_ship @if($k%3 == 2)mar_0 @endif">
                            <div class="export_ship_img">
                                <a href="/info/{{$v->id}}"><img src="{{$v->portrait}}" /></a>
                            </div>
                            <div class="export_ship_txt">
                                <p>专家: {{$v->username}}</p>
                                <p>职位: {{$v->post}}</p>
                                <p>科室: {{$v->department}}</p>
                                <p>医院: {{$v->hospital}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection