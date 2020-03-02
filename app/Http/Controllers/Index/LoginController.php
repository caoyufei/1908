<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

use App\Member;

class LoginController extends Controller
{
    public function reg(){
    	return view('index.reg');
    }

     public function ajaxsend(){
    	//接受注册页面的手机号
    	//$mobile='15234814763';
    	$mobile = request()->mobile;
    	$code = rand(1000,9999);

    	$res = $this->sendSms($mobile,$code);
 		dd($res);die;
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();

    		echo json_encode(['code'=>'00000','msg'=>'ok']);die;
    	}

    		echo json_encode(['code'=>'00000','msg'=>'短信发送失败']);die;
    }

     public function sendSms($mobile,$code){

			AlibabaCloud::accessKeyClient('LTAI4FqhiMhghFDHStMtVwio','iJydWWlZZFXePOYrsntYgCU7oXG27E')
			                        ->regionId('cn-hangzhou')
			                        ->asDefaultClient();

			try {
			    $result = AlibabaCloud::rpc()
			                          ->product('Dysmsapi')
			                          // ->scheme('https') // https | http
			                          ->version('2017-05-25')
			                          ->action('SendSms')
			                          ->method('POST')
			                          ->host('dysmsapi.aliyuncs.com')
			                          ->options([
			                                        'query' => [
			                                          'RegionId' => "cn-hangzhou",
			                                          'PhoneNumbers' =>$mobile,
			                                          'SignName' => "星辰大海",
			                                          'TemplateCode' => "SMS_181860274",
			                                          'TemplateParam' => "{code:$code}",
			                                        ],
			                                    ])
			                          ->request();
			    return $result->toArray();
			} catch (ClientException $e) {
			    return $e->getErrorMessage();
			} catch (ServerException $e) {
			    return $e->getErrorMessage();
			}
    }
    //判断验证码
    public function regdo(){
    	$post=request()->except('_token');
    	$code=session('code');
    	if($code!==$post['code']){
    		return redirect('/reg')->with('msg','您输入的验证码不对');
    	}

    	//密码与确认密码是否一致
    	if($post['pwd']!==$post['repwd']){
    		return redirect('/reg')->with('msg','两次密码不一致');
    	}

    	//入库
    	$user=[
    		'mobile'=>$post['mobile'],
    		'add_time'=>time(),
    		'pwd'=>encrypt($post['pwd']),
    	];
    	$res=Member::create($user);
    	if($res){
    		return redirect('/login');
    	}
    }
}
