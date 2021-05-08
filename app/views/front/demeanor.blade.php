@extends("common.front-layout")
@section("title","名家风采")
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
    <div class="export">
        <div class="export_list clearfix">
            @foreach($experts as $v)
            <div class="export_ship">
                <div class="export_ship_img">
                    <a href="/info/{{$v->id}}"><img src="{{$v->portrait}}" /></a>
                </div>
                <div class="export_ship_txt">
                    <p>专家：{{$v->username}}</p>
                    <p>职位：{{$v->post}}</p>
                    <p>科室：{{$v->department}}</p>
                    <p>医院：{{$v->hospital}}</p>
                </div>
            </div>
            @endforeach
        </div>
        {{$experts->links()}}
    </div>
@endsection

