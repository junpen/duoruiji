@extends("common.admin-layout")
@section("content")
    <form method="post" action="/adm/live/delete-live">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <h1 style="text-align: center"> 删除视频</h1>
        <p style="text-align: center">将要删除标题为{{$live->title}}的视频？</p>
        <p></p>
        <div class="form-group">
            <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="id" value={{$live->id}}>
        </div>
        <div style="text-align: center">
            <a href="/adm/live"><button type="button" class="btn btn-secondary">取消</button></a>
            <button type="submit" class="btn btn-danger">提交</button>
        </div>
    </form>
@endsection


