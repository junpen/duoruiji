@extends("common.admin-layout")
@section("content")
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>重置密码</h3>
    </div>
    <form class="form-horizontal"  method="post" action="/adm/user/edit-user">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <input type="hidden" class="form-control" style="width:300px;" id="id" name="id" value="{{$user->id}}">
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"><span style="color:red;">*</span>输入新密码</label>
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
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>
    </form>
    @if(isset($error))
        {{$error}}
    @endif
@endsection