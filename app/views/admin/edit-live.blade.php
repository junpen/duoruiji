@extends("common.admin-layout")
@section("content")
    <script type="text/javascript" src="/admin/assets/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/assets/js/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="/admin/assets/js/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script src="/admin/assets/js/ajaxfileupload.js"></script>
    <script src="/admin/assets/js/DatePicker/WdatePicker.js" type="text/javascript"></script>
    <link type="text/css" href="/admin/assets/js/date/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    <link type="text/css" href="/admin/assets/js/date/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
    <script type="text/javascript" src="/admin/assets/js/date/js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="/admin/assets/js/date/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/admin/assets/js/date/js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".ui_timepicker").datetimepicker({
                showSecond: true,
                timeFormat: 'hh:mm:ss',
                stepHour: 1,
                stepMinute: 1,
                stepSecond: 1
            })
        })
    </script>
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>编辑视频</h3>
    </div>
    @if(count($errors)>0)
        <div class="alert-danger">
            <ul>
                @foreach($errors->all() as $errors)
                    <li>{{$errors}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-horizontal"  method="post" action="/adm/live/edit-live">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id" value="{{$live->id}}">
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span>标题</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="{{$live->title}}">
            </div>
        </div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label"><span style="color:red;">*</span>视频路径</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" name="url" value="{{$live->path}}">
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label"><span style="color:red;">*</span>视频类型</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="type" id="video_type1" value="0"  @if($live->type==0) checked @endif > 录播
                </label>
                <label class="radio-inline">
                    <input type="radio" name="type" id="video_type2" value="1" @if($live->type==1) checked @endif> 直播
                </label>
            </div>
        </div>
        <div class="form-group" >
            <label for="description" class="col-sm-2 control-label"><span style="color:red;">*</span>课程简介</label>
            <div class="col-sm-10">
                <script id="description" name="description" type="text/plain">{{$live->introduction}}</script>
                <script type="text/javascript">
                    var editor = UE.getEditor('description')
                </script>
            </div>
        </div>
        <div class="form-group">
            <label for="doc_department" class="col-sm-2 control-label"><span style="color:red;">*</span>直播开始时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control ui_timepicker" id="start_time" name="start_time" value="{{$live->begin}}">
            </div>
        </div>
        <div class="form-group">
            <label for="doc_hospital" class="col-sm-2 control-label"><span style="color:red;">*</span>直播结束时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control ui_timepicker" id="end_time" name="end_time" value="{{$live->end}}" >
            </div>
        </div>
        <div class="form-group">
            <label for="upload_file" class="col-sm-2 control-label"><span style="color:red;">*</span>缩略图</label>
            <div class="col-sm-10">
                <input  id="upload_file" name="upload_file"  type="file" onchange="saveThumb()"/>
                <input type="hidden" class="form-control" id="img_thumb" name="img_thumb" value="{{$live->portrait}}" >
                <img style="width:320px;height:200px;" alt="" id="thumb" src="{{$live->portrait}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="expertlist" class="col-sm-2 control-label"><span style="color:red;">*</span>关联专家</label>
            <div class="col-sm-10">
                <select id="expert" name="expert">
                    <option value="">请选择</option>
                    @foreach($experts as $v)
                        <option value="{{$v->username}}">{{$v->username}}</option>
                    @endforeach
                </select>
                <button class="btn btn-default" type="button" onclick="addexpert()">添加</button>
                <style>
                    .expert{margin:5px;}
                </style>
                <div id="expertlist" name="expertlist"></div>
                @foreach($expert as $v)
                    <div>
                        <input type="hidden" value="{{$v->id}}" name="doc_id[]">
                        <span class="expert">{{$v->username}}</span>
                        <span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>
    </form>
    <script>
        function addexpert(){
            var expert = $('#expert option:selected');
            var flag = true;
            var experthtml = '';
            if(expert.val()){
                $('#expertlist').find('input').each(function(){
                    if($(this).val()==expert.val()){
                        flag = false;
                        return false;
                    }
                });
                if(flag){
                    experthtml += '<div>';
                    experthtml += '		<input type="hidden" value="'+expert.val()+'" name="doc_id[]">';
                    experthtml += '		<span class="expert">'+expert.text()+'</span>';
                    experthtml += '		<span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>';
                    experthtml += '</div>';
                    $('#expertlist').append(experthtml);
                }else{
                    alert('您已经添加过该专家了');
                    return false;
                }
            }else{
                alert('请先选择一个专家');
                return false;
            }
        }

        function saveThumb() {
            $.ajaxFileUpload({
                url: "/adm/live/upload-video-thumb",
                secureuri: false,
                fileElementId: "upload_file",
                dataType: "json",
                data:{_token:$("#_token").val()},
                success: function(data, status) {
                    if(data.success){
                        $("#img_thumb").val(data.img_thumb);
                        $("#thumb").attr("src", data.img_thumb);
                        alert("上传成功");
                    }else{
                        alert(data.msg);}

                }
            })
        }
    </script>
@endsection
