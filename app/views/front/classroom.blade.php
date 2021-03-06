@extends("common.front-layout")
@section("title","名家讲堂")
@section("content")
    <div class="head">
        <div class="nav">
            <ul class="nav_body">
                <li><a href="/">首页</a></li>
                <li><a class="current" href="/conf">名家讲堂</a></li>
                <li><a href="/expert">名家风采</a></li>
                <li><a href="/review">往期视频</a></li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="online">
            <div class="online_class">
                <div class="online_class_bg"><img src="/front/assets/images/last_time_bg.jpg" /></div>
                @if($state == 1)
                    <div class="online_class_body">
                        <input type="hidden" id="meeting_start_time" value="{{$time}}">
                        <a class="class_href" href="javascript:nothing()"></a>
                        <div class="before">
                            <div class="last_time_big">
                                <span id="time1" class="time1">00</span>
                                <span id="time2" class="time2">00</span>
                                <span id="time3" class="time3">00</span>
                                <span id="time4" class="time4">00</span>
                            </div>
                        </div>
                        <div class="online_export_box">
                            <div class="online_export_bg"></div>
                            <div class="online_export clearfix">
                                <div class="online_export_ship">
                                    <div class="online_export_img">
                                        <a href="/info/{{$expert->id}}"><img src="{{$expert->portrait}}" /></a>
                                    </div>
                                    <div class="online_export_txt">
                                        <p>专家：{{$expert->name}}  教授</p>
                                        <p>医院：{{$expert->hospital}}</p>
                                        <p>科室：{{$expert->department}}</p>
                                        <p>职称：{{$expert->title}}</p>
                                    </div>
                                </div>
                                <div class="online_export_ship border_left">
                                    <div class="online_export_intro">
                                        <p><b>课程简介</b></p>
                                        <p>{{$description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="char_pop" class="chat_pop" style="display:none" >
                            <div class="chat_pop_top"><a href="javascript:Pop_close()" class="chat_pop_close"></a></div>
                            <div class="chat_pop_body">
                                <img src="{{$qrcode}}" />
                                <p>使用微信扫一扫，并将网页分享给好友</p>
                            </div>
                        </div>
                    </div>
                    <div id="cover" class="phone_page" style="display: none">
                        <div class="phone_top"><img src="/front/assets/images/top.png" /></div>
                        <div class="know"><a href="javascript:quit_pop()"><img src="/front/assets/images/btn_bg.png" /></a></div>
                    </div>
                    <div class="online_class_share">
                        <span>分享到：</span>
                        <a href="javascript:Pop_on_wx()"><img src="/front/assets/images/icon_weixin.jpg" /></a>
                    </div>
                    <script src="{{asset('front/assets/js/timer.js')}}"></script>
                @else
                    @if($state == 2)
                        <div class="online_class_body">
                            <!--会议进行中-->
                            <input type="hidden" id="url" value="{{$url}}" />
                            <div class="meeting" >
                                <a href="javascript:Pop_on_input()">
                                    <img src="/front/assets/images/online_classing.png" />
                                </a>
                            </div>
                        </div>
                        <div class="online_class_share">
                            <span>分享到：</span>
                            <a href="javascript:Pop_on_wx()"><img src="/front/assets/images/icon_weixin.jpg" /></a>
                        </div>
                        <div id="char_pop" class="chat_pop" style="display:none" >
                            <div class="chat_pop_top"><a href="javascript:Pop_close()" class="chat_pop_close"></a></div>
                            <div class="chat_pop_body">
                                <img src="{{$qrcode}}" />
                                <p>使用微信扫一扫，并将网页分享给好友</p>
                            </div>
                        </div>
                        <div id="name_pop" class="export_pop" style="display:none">
                            <div class="export_pop_top">
                                <span>提示</span>
                                <a href="javascript:Pop_close()" class="export_pop_close"></a>
                            </div>
                            <div class="export_pop_body">
                                <div>请输入您的姓名：</div>
                                <div class="export_name_input"><input id="nick_name" type="text" /></div>
                                <div class="export_name_submit"><input type="button" class="btn blue_btn" value="确定" onclick="join_meeting()"/></div>
                            </div>
                        </div>
                        <div id="cover" class="phone_page" style="display: none">
                            <div class="phone_top"><img src="/front/assets/images/top.png" /></div>
                            <div class="know"><a href="javascript:quit_pop()"><img src="/front/assets/images/btn_bg.png" /></a></div>
                        </div>
                    @else
                        <div class="online_class_body">
                            <div class="end_title" >会议已结束</div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection