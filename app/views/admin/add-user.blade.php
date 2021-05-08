@extends("common.admin-layout")
@section("content")
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>新增管理员</h3>
    </div>
    <form class="form-horizontal"  method="post" action="/adm/user/add-user">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label"><span style="color:red;">*</span>用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" style="width:300px;" id="username" name="username" >
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"><span style="color:red;">*</span>密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" style="width:300px;" id="password" name="password" >
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label"><span style="color:red;">*</span>确认密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" style="width:300px;" id="password_confirmation" name="password_confirmation" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" onclick="addUser()" value="确定">
            </div>
        </div>
    </form>
    <script type="text/javascript" language="javascript">
        function addUser()
        {
            var name=$("#username").val();
            if(name==""){
                alert("用户名不能为空");
                $("#username").focus();
                return;
            }
            var pwd=$("#password").val();
            if(pwd==""){
                alert("密码不能为空");
                $("#password").focus();
                return;
            }
            var repwd=$("#password_confirmation").val();
            if(repwd==""){
                alert("确认密码不能为空");
                $("#password_confirmation").focus();
                return;
            }
            if(pwd!=repwd){
                alert("两次输入密码不一致");
                $("#password").focus();
                return;
            }
            $.ajax({
                data:{"name":name,"pwd":pwd},
                dataType:"json",
                type:"post",
                url:"/adm/user/add-user",
                success:function(data){
                    if(!data.status){
                        alert("用户名已存在");
                    }else if(data.status){
                        alert("添加成功");
                        location.href="/adm/user";
                    }else{
                        alert("未知错误");
                    }
                }
            });
        }
    </script>
@endsection


