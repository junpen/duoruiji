<?php


class ExpertController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('Login','DoLogin')));
    }

    public function getIndex()
    {
        $experts=Expert::orderby('id','desc')->paginate(5);
        return View::make("admin.expert")->with("experts",$experts);
    }

    public function getAddExpert()
    {
        return View::make("admin.add-expert");
    }

    public function postAddExpert()
    {
        $rules = array(
            'username'  		=> 'required',
            'photo'  		=> 'required',
            'department'    => 'required',
            'title'  		=> 'required',
            'postion'  		=> 'required',
            'hospital'  	=> 'required',
            'description'   => 'required',
            'education'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors=$validator->messages();
            return Redirect::to('/adm/expert/add-expert')->withErrors($errors);
        }
        $username=Input::get('username');
        $upload=Input::get('photo');
        $department=Input::get('department');
        $title=Input::get('title');
        $postion=Input::get('postion');
        $hospital=Input::get('hospital');
        $description=Input::get('description');
        $education=Input::get('education');
        $expert=new Expert();
        $expert->username=$username;
        $expert->portrait=$upload;
        $expert->department=$department;
        $expert->title=$title;
        $expert->post=$postion;
        $expert->hospital=$hospital;
        $expert->introduction=$description;
        $expert->education=$education;
        $expert->save();
        return Redirect::to('/adm/expert');
    }

    public function getEditExpert($id)
    {
        $expert=Expert::find($id);
        return View::make("admin.edit-expert")->with("expert",$expert);
    }

    public function postEditExpert()
    {
        $rules = array(
            'username'  		=> 'required',
            'photo'  		=> 'required',
            'department'    => 'required',
            'title'  		=> 'required',
            'postion'  		=> 'required',
            'hospital'  	=> 'required',
            'description'   => 'required',
            'education'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors=$validator->messages();
            return Redirect::to('/adm/expert/edit-expert')->withErrors($errors);
        }
        $id=Input::get('id');
        $username=Input::get('username');
        $upload=Input::get('photo');
        $department=Input::get('department');
        $title=Input::get('title');
        $postion=Input::get('postion');
        $hospital=Input::get('hospital');
        $description=Input::get('description');
        $education=Input::get('education');
        $expert=Expert::find($id);
        $expert->username=$username;
        $expert->portrait=$upload;
        $expert->department=$department;
        $expert->title=$title;
        $expert->post=$postion;
        $expert->hospital=$hospital;
        $expert->introduction=$description;
        $expert->education=$education;
        $expert->save();
        return Redirect::to('/adm/expert');
    }

    public function getDeleteExpert($id){
        $expert = Expert::find($id);
        return View::make('admin.delete-expert')->with('expert',$expert);
    }

    public function postDeleteExpert(){
        $id=Input::get('id');
        $expert=Expert::find($id);
        $expert->delete();
        return Redirect::to('/adm/expert');
    }

    public function postUploadDocThumb(){
        if($_FILES['upload_file']['error']>0){
            return json_encode(array('success'=>false,'msg'=>'上传失败'));
        }else{
            $attach_filename = $_FILES['upload_file']['name'];
            $attach_fileext = $this->get_filetype($attach_filename);
            $rand_name = date('YmdHis', time()).rand(1000,9999);
            $sFileName = $rand_name.'.'.$attach_fileext;
            $sPath = "/upload/expert_thumb/$attach_fileext/".date('Ymd',time());
            $sRealPath = public_path().$sPath;
            $this->mkdirs($sRealPath);
            move_uploaded_file($_FILES['upload_file']['tmp_name'], $sRealPath.'/'.$sFileName);
            $sFileNameS = $rand_name . '_s.' . $attach_fileext;
            $this->resizeImage ( $sRealPath.'/'.$sFileName, $sRealPath.'/'.$sFileNameS, 1000, 1000 );
            $sFileUrl = $sPath.'/'.$sFileNameS;
            $json = array('success'=>true,'photo'=>$sFileUrl);
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

    public function postExpertSearch()
    {
        $search=Input::get('search');
        $experts=Expert::where('username','like','%'.$search.'%')->paginate(5);
        if($experts->count()>0)
        {
            return View::make('admin.expert')->with('experts',$experts);
        }else{
            $error="无搜索内容，请重新输入";
            $experts=Expert::paginate(5);
            return View::make('admin.expert')->with('experts',$experts)->with('error',$error);
        }
    }
}