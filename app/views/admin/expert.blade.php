@extends("common.admin-layout")
@section("content")
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>专家列表</h3>
    </div>
    <form class="form-inline mt-2 mt-md-0" method="post" action="/adm/expert/expert-search">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form>
    @if(isset($error))
        {{$error}}
    @endif
    <div>
        <div style="float:right;">
            <button type="button" class="btn btn-primary" onclick="window.location.href = '/adm/expert/add-expert'">新增专家</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>职称</th>
            <th>科室</th>
            <th>医院</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($experts as $v)
            <tr>
                <th scope="row">{{$v->id}}</th>
                <td>{{$v->username}}</td>
                <td>{{$v->title}}</td>
                <td>{{$v->department}}</td>
                <td>{{$v->hospital}}</td>
                <td>
                    <a href="/adm/expert/edit-expert/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    &nbsp;&nbsp;
                    <a href="/adm/expert/delete-expert/{{$v->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$experts->links()}}
@endsection

