@extends("common.admin-layout")
@section("content")
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>管理员用户列表</h3>
    </div>
    <div>
        <div style="float:right;">
            <button type="buttn" class="btn btn-primary" onclick="window.location.href = '/adm/user/add-user'">添加管理员</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>更改密码</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $v)
        <tr>
            <th scope="row">{{$v->id}}</th>
            <td>{{$v->username}}</td>
            <td>
                <a  type="button" onclick="window.location.href = '/adm/user/edit-user/{{$v->id}}'"> 更改密码</a></td>
            <td>&nbsp;&nbsp;&nbsp;
                <a onclick="deleteUser({{$v->id}})" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
    <script type="text/javascript" language="javascript">
        function deleteUser(id)
        {
            if(id=={{Auth::user()->id}})
            {
                alert("不能删除当前登录用户");
                return;
            }
            if(confirm("确认删除吗？"))
            {
                $.post("/adm/user/delete-user",{'_token':"{{csrf_token()}}",'id':id},function(data){
                    alert(data);
                    location.reload();
                });
            }
        }
    </script>
@stop
@endsection
