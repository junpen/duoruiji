<?php


class FrontController extends BaseController
{
    public function getIndex()
    {
        $time=0;
        $ConfId=-1;
        $url=" ";
        $qrcode="";
        $lives=Live::select('id','portrait','title','begin','eid','associate')->where('type','=','0')->orderBy('created_at','desc')->take(3)->get();
        $RecentConf=$this->RecentVideo();
        $experts=Expert::select()->orderBy('created_at','DESC')->take(2)->get();
        if($RecentConf == null)
        {
            $state=0;
        }
        else
        {
            $ConfId=$RecentConf->id;
            $backImg=$RecentConf->portrait;
            $CurrentUrl=$RecentConf->path;
            $filename=$RecentConf->id;
            $qrcode=$this->getQrcode($CurrentUrl, $filename);
            $now=time();
            if(strtotime($RecentConf->begin)> $now)
            {
                $state=1;
                $time=strtotime($RecentConf->begin);
            }
            else
            {
                $state=2;
                $url=$RecentConf->path;
            }
        }
        return View::make('front.index')
            ->with(array(
                'lives' => $lives,
                'state'=>$state,
                'experts'=>$experts,
                'time'=>$time,
                'ConfId'=>$ConfId,
                'url'=>$url,
                'qrcode'=>$qrcode
            ));
    }

    public function RecentVideo()
    {
        $now=date('Y-m-d H:i:s');
        $lives=Live::where('end','>',$now)->where('type','=','1')->orderBy('begin','ASC')->first();
        return $lives;
    }

    public function getQrcode($data,$name)
    {
        ini_set('display_errors', 'on');
        $PNG_TEMP_DIR = public_path().'/upload/2dbarcode/';
        $PNG_WEB_DIR = '/upload/2dbarcode/';
        require app_path()."/extends/phpqrcode/qrlib.php";
        $ecc = 'H';
        $size = "50";
        $filename = $PNG_TEMP_DIR.$name.'.png';
        $code= $PNG_WEB_DIR.basename($filename);
        if(!file_exists($PNG_TEMP_DIR))
            $this->mkdirs($PNG_TEMP_DIR);
        if(!file_exists($filename))
        {
            QRcode::png($data, $filename, $ecc, $size, 2);
            chmod($filename, 0777);
        }
        return $code;
    }

    function mkdirs($path, $mode = 0777)
    {
        if(!file_exists($path))
        {
            $this->mkdirs(dirname($path), $mode);
            mkdir($path,$mode);
        }
    }

    public function getConf()
    {
        $qrcode="";
        $RecentConf = $this->RecentVideo();
        if($RecentConf == null)
        {
            $state = 0;
            return View::make('front.classroom')
                ->with('state' , $state)
                ->with('qrcode' ,$qrcode);
        }
        else
        {
            $CurrentUrl=$RecentConf->path;
            $filename=$RecentConf->id;
            $qrcode=$this->getQrcode($CurrentUrl, $filename);
            $backImg = $RecentConf->portrait;
            $expert = $this->GetMainExpert();
            $description= $RecentConf->introduction;
            $now = time();
            if(strtotime($RecentConf->begin)> $now)
            {
                $state = 1;
                $time = strtotime($RecentConf->begin);
                return View::make('front.classroom')
                    ->with(array('state'=>$state,
                        'expert'=>$expert,
                        'time'=>$time,
                        'description' => $description,
                        'url'=>$CurrentUrl,
                        'qrcode' => $qrcode));
            }
            else
            {
                $state = 2;
                return View::make('front.classroom')
                    ->with(array('state' => $state,
                        'url' => $CurrentUrl,
                        'expert' => $expert,
                        'description' => $description,
                        'qrcode' => $qrcode));
            }
        }
    }

    function GetMainExpert()
    {
        $now=date('Y-m-d H:i:s');
        $lives=Live::where('end','>',$now)->where('type','=','1')->orderBy('begin','ASC')->first();
        if($lives)
        {
            $expert=Expert::where('username',$lives->associate)->first();
        }else{
            $expert="";
        }
        return $expert;
    }

    public function getExpert()
    {
        $experts=Expert::orderby('id','desc')->paginate(9);
        return View::make("front.demeanor")->with("experts",$experts);;
    }

    public function getInfo($id)
    {
        $expert=Expert::find($id);
        $otherExperts=Expert::where("id","!=",$id)->get();
        if(count($otherExperts))
        {
            return View::make('front.demeanor-details')
                ->with('expert',$expert)
                ->with('otherExperts',$otherExperts);
        }
        else
        {   return View::make('front.demeanor-details')
            ->with('expert',$expert);
        }

    }

    public function getReview()
    {
        $lives=Live::where('type','0')->orderBy('end','Desc')->paginate(9);
        return View::make("front.past")->with("lives",$lives);
    }

    public function getReviewInfo($id)
    {
        $live = Live::find($id);
        $sUrl="http://".$_SERVER['SERVER_NAME']."/review-info/".$id;
        $qrcode=$this->getQrcode($sUrl,$live->id);
        $expert=Expert::where('username',$live->associate)->first();
        $videoother = Live::where('type','0')
            ->where('id',"<>",$id)
            ->orderBy('end','Desc')
            ->first();

        return View::make('front.past-details')
            ->with('live',$live)
            ->with('videoother',$videoother)
            ->with('expert',$expert)
            ->with('qrcode' ,$qrcode);;
    }
}