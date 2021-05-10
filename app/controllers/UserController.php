<?php


class UserController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('Login','DoLogin')));
    }

    public function adminIndex()
    {
        return View::make("admin.index");
    }

    public function getIndex()
    {
        $users=User::paginate(5);
        return View::make("admin.user")->with("users",$users);
    }

    public function getAddUser()
    {
        return View::make("admin.add-user");
    }

    public function postAddUser(){
        $username=$_POST["name"];
        $password=$_POST["pwd"];
        $a=DB::table('users')->where('username',$username)->get();
        $user=new User();
        $user->username=$username;
        $user->password=Hash::make($password);
        if($a){
            $data = array("status" => false);//用户已存在
        }else {
            $user->save();
            $data = array("status" => true);//将User成功添加到数据库
        }
        return json_encode($data);
    }

    public function getEditUser($id){
        $user = User::find($id);
        return View::make('admin.edit-user')->with('user',$user);
    }

    public function postEditUser(){
        $id=Input::get('id');
        $password=Input::get('password');
        $password_confirmation=Input::get('password_confirmation');
        $user=User::find($id);
        if($password=="")
        {
            $error="密码不能为空，请重新输入";
            return View::make('admin.edit-user')->with('user',$user)->with('error',$error);
        }else if($password!=$password_confirmation)
        {
            $error="两次密码输入不一致，请重新输入";
            return View::make('admin.edit-user')->with('user',$user)->with('error',$error);
        }else{
            $user->password=Hash::make($password);
            $user->save();
            return Redirect::to('/adm/user');
        }
    }

    public function postDeleteUser()
    {
            $id=Input::get('id');
            $user=User::find($id);
            $user->delete();
            return "删除成功";
    }

    public function Login()
    {
        return View::make("admin.login");
    }

    public function DoLogin(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(Auth::attempt(array('username'=>$username,'password'=>$password))) {
            $data = array("status" => true);
        }else{
            $data = array("status"=>false);
        }
        return json_encode($data);
    }

    public function Logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}