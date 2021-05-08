@extends("common.admin-layout")
@section("content")
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>直播录播管理</h3>
    </div>
    <form class="form-inline mt-2 mt-md-0" method="post" action="/adm/live/live-search">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form>
    @if(isset($error))
        {{$error}}
    @endif
    <div>
        <div style="float:right;">
            <button type="button" class="btn btn-primary" onclick="window.location.href = '/adm/live/add-live'">新增视频</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>科室</th>
            <th>专家</th>
            <th>类型</th>
            <th>直播开始时间</th>
            <th>直播结束时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lives as $v)
            <tr>
                <th scope="row">{{$v->id}}</th>
                <td>{{$v->title}}</td>
                <td>@if(empty($v->associate)==0){{$v->edepartment}}@endif</td>
                <td>@if(empty($v->associate)==0){{$v->associate}}@endif</td>
                <td>{{($v->type==1)?"直播":"录播"}}</td>
                <td>{{$v->begin}}</td>
                <td>{{$v->end}}</td>
                <td>
                    <a href="/adm/live/edit-live/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    &nbsp;&nbsp;
                    <a href="/adm/live/delete-live/{{$v->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$lives->links()}}
@endsection


