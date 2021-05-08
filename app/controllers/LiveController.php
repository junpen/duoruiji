<?php


class LiveController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('Login','DoLogin')));
    }

    public function getIndex()
    {
        $lives=Live::paginate(5);
        return View::make("admin.live")->with("lives",$lives);
    }

    public function getAddLive()
    {
        $experts = Expert::All()->lists('username','id');
        return View::make("admin.add-live")->with('experts',$experts);
    }

    public function postAddLive()
    {
        $rules = array(
            'title'  		=> 'required',
            'url'  		=> 'required',
            'type'  		=> 'required',
            'description'  		=> 'required',
            'start_time'  		=> 'required',
            'end_time'    => 'required',
            'img_thumb'  	=> 'required',
            'expert'     =>  'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors=$validator->messages();
            return Redirect::to('/adm/live/add-live')->withErrors($errors);
        }
        $title=Input::get("title");
        $url=Input::get("url");
        $type=Input::get("type");
        $description=Input::get("description");
        $start_time=Input::get("start_time");
        $end_time=Input::get("end_time");
        $upload_file=Input::get("img_thumb");
        $expert=Input::get("expert");
        $exper=DB::table('experts')->where('username',$expert)->first();
        $live=new Live();
        $live->title=$title;
        $live->path=$url;
        $live->type=$type;
        $live->introduction=$description;
        $live->begin=$start_time;
        $live->end=$end_time;
        $live->portrait=$upload_file;
        $live->associate=$expert;
        $live->eid=$exper->id;
        $live->edepartment=$exper->department;
        $live->ephoto=$exper->portrait;
        $live->save();
        return Redirect::to('/adm/live');
    }

    public function getEditLive($id)
    {
        $live=Live::find($id);
        $experts = Expert::All();
        $expert = DB::table('experts')->where("id",$live->eid)->get();
        return View::make("admin.edit-live")->with("live",$live)->with("experts",$experts)->with("expert",$expert);
    }

    public function postEditLive()
    {
        $rules = array(
            'title'  		=> 'required',
            'url'  		=> 'required',
            'type'  		=> 'required',
            'description'  		=> 'required',
            'start_time'  		=> 'required',
            'end_time'    => 'required',
            'img_thumb'  	=> 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors=$validator->messages();
            return Redirect::to('/adm/live/edit-live')->withErrors($errors);
        }
        $id=Input::get('id');
        $title=Input::get('title');
        $url=Input::get('url');
        $type=Input::get('type');
        $description=Input::get("description");
        $start_time=Input::get("start_time");
        $end_time=Input::get("end_time");
        $upload_file=Input::get("img_thumb");
        $expert=Input::get("expert");
        $exp=DB::table('experts')->where("username",$expert)->get();
        $live=Live::find($id);
        $exper=Expert::find($live->eid);
        $live->title=$title;
        $live->path=$url;
        $live->type=$type;
        $live->introduction=$description;
        $live->begin=$start_time;
        $live->end=$end_time;
        $live->portrait=$upload_file;
        if($expert=="")
        {
            $live->associate=$exper->username;
            $live->eid=$exper->id;
            $live->edepartment=$exper->department;
            $live->ephoto=$exper->portrait;
        }elseif($exper==""){
            $live->associate=$expert;
            $live->eid=$exp->id;
            $live->edepartment=$exp->department;
            $live->ephoto=$exp->portrait;
        }
        $live->save();
        return Redirect::to('/adm/live');
    }

    public function getDeleteLive($id){
        $live = Live::find($id);
        return View::make('admin.delete-live')->with('live',$live);
    }

    public function postDeleteLive(){
        $id=Input::get('id');
        $live=Live::find($id);
        $live->delete();
        return Redirect::to('/adm/live');
    }

    public function postUploadVideoThumb(){
        if($_FILES['upload_file']['error']>0){
            return json_encode(array('success'=>false,'msg'=>'上传失败'));
        }else{
            $attach_filename = $_FILES['upload_file']['name'];
            $attach_fileext = $this->get_filetype($attach_filename);
            $rand_name = date('YmdHis', time()).rand(1000,9999);

            $sFileName = $rand_name.'.'.$attach_fileext;

            $sPath = "/upload/video_thumb/$attach_fileext/".date('Ymd',time());

            $sRealPath = public_path().$sPath;
            $this->mkdirs($sRealPath);
            move_uploaded_file($_FILES['upload_file']['tmp_name'], $sRealPath.'/'.$sFileName);

            $sFileNameS = $rand_name . '_s.' . $attach_fileext;
            $this->resizeImage ( $sRealPath.'/'.$sFileName, $sRealPath.'/'.$sFileNameS, 1060, 620 );

            $sFileUrl = $sPath.'/'.$sFileNameS;
            $json=array('success'=>true,'img_thumb'=>$sFileUrl);
            echo json_encode($json);
            die;
        }
    }

    function get_filetype($filename) {
        $extend = explode("." , $filename);
        return strtolower($extend[count($extend) - 1]);
    }

    function mkdirs($path, $mode = 0777)
    {
        if(!file_exists($path))
        {
            $this->mkdirs(dirname($path), $mode);
            mkdir($path,$mode);
        }
    }

    function resizeImage($im, $dest, $maxwidth, $maxheight) {
        $img = getimagesize($im);
        switch ($img[2]) {
            case 1:
                $im = @imagecreatefromgif($im);
                break;
            case 2:
                $im = @imagecreatefromjpeg($im);
                break;
            case 3:
                $im = @imagecreatefrompng($im);
                break;
        }
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);
        $resizewidth_tag = false;
        $resizeheight_tag = false;
        if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
            if ($maxwidth && $pic_width > $maxwidth) {
                $widthratio = $maxwidth / $pic_width;
                $resizewidth_tag = true;
            }
            if ($maxheight && $pic_height > $maxheight) {
                $heightratio = $maxheight / $pic_height;
                $resizeheight_tag = true;
            }
            if ($resizewidth_tag && $resizeheight_tag) {
                if ($widthratio < $heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }
            if ($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if ($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;
            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;
            if (function_exists("imagecopyresampled")) {
                $newim = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            } else {
                $newim = imagecreate($newwidth, $newheight);
                imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            }
            imagejpeg($newim, $dest);
            imagedestroy($newim);
        } else {
            imagejpeg($im, $dest);
        }
    }

    public function postLiveSearch()
    {
        $search=Input::get('search');
        $lives=Live::where('title','like','%'.$search.'%')->paginate(5);
        if($lives->count()>0)
        {
            return View::make('admin.live')->with('lives',$lives);
        }else{
            $error="无搜索内容，请重新输入";
            $lives=Live::paginate(5);
            return View::make('admin.live')->with('lives',$lives)->with('error',$error);
        }
    }
}