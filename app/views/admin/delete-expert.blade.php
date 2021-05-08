@extends("common.admin-layout")
@section("content")
    <form method="post" action="/adm/expert/delete-expert">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <h1 style="text-align: center"> 删除专家</h1>
        <p style="text-align: center">将要删除专家名为{{$expert->username}}？</p>
        <p></p>
        <div class="form-group">
            <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="id" value={{$expert->id}}>
        </div>
        <div style="text-align: center">
            <a href="/adm/expert"><button type="button" class="btn btn-secondary">取消</button></a>
            <button type="submit" class="btn btn-danger">提交</button>
        </div>
    </form>
@endsection


