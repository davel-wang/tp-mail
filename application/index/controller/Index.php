<?php
namespace app\index\controller;

use PHPMailer\PHPMailer\PHPMailer;
use think\Controller;
use think\Exception;

class Index extends  Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function email_system() {
        $data = cache('email_system');
        if(!$data) $data = [];
        return [
            'code' => 0,
            'msg' => 'success',
            'count' => count($data),
            'data' => $data,
        ];
    }

    public function email_system_add() {
        $data = cache('email_system');
        if(!$data) $data = [];
        $data[] = [
            'ip' => input('ip',''),
            'port' => input('port',''),
            'user' => input('user',''),
            'pwd' => input('pwd',''),
            'ssl' => input('ssl',0,'intval'),
        ];
        cache('email_system',$data);
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => null,
        ];
    }

    public function email_system_del() {
        $data = cache('email_system');
        if($data) {
            $user = input('user');
            foreach ($data as $key=>$item) {
                if($item['user']==$user) {
                    unset($data[$key]);
                }
            }
            cache('email_system',$data);
        }
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => null,
        ];
    }

    public function email_user() {
        $data = cache('email_user');
        if(!$data) $data = [];
        return [
            'code' => 0,
            'msg' => 'success',
            'count' => count($data),
            'data' => $data,
        ];
    }

    public function email_user_add() {
        $data = cache('email_user');
        if(!$data) $data = [];
        $data[] = [
            'email' => input('email',''),
        ];
        cache('email_user',$data);
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => null,
        ];
    }

    public function email_user_del() {
        $data = cache('email_user');
        if($data) {
            $email = input('email');
            foreach ($data as $key=>$item) {
                if($item['email']==$email) {
                    unset($data[$key]);
                }
            }
            cache('email_user',$data);
        }
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => null,
        ];
    }

    public function sender() {
        $server = [
            'ip' => input('ip',''),
            'port' => input('port',''),
            'user' => input('user',''),
            'pwd' => input('pwd',''),
            'ssl' => input('ssl',0,'intval'),
        ];
        $email = input('email');
        $msg = $server['user'].' to '.$email .' result:';
        try{
            $mail=new PHPMailer();//建立邮件发送类
            $mail->IsSMTP();//使用SMTP方式发送 设置设置邮件的字符编码，若不指定，则为'UTF-8
            $mail->Host= $server['ip'];//'smtp.qq.com';//您的企业邮局域名
            $mail->Port = $server['port'];
            if($server['ssl']) $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth= true;//启用SMTP验证功能   设置用户名和密码。
            $mail->SMTPAutoTLS = false;
            $mail->Username= $server['user'];
            $mail->Password= $server['pwd'];//'xiaowei7758258'//邮局密码
            $mail->From= $server['user'];//'mail@koumang.com'//邮件发送者email地址
            $mail->FromName= 'From '.$server['user'];//邮件发送者名称
            $mail->AddAddress($email);// 收件人邮箱，收件人姓名
            $mail->Encoding = PHPMailer::ENCODING_QUOTED_PRINTABLE;
            $mail->IsHTML(true);
            $mail->CharSet= 'UTF-8';
            $mail->Subject="=?UTF-8?B?".base64_encode('From '.$server['user'])."?=";
            $mail->Body= 'Say Hello'; //邮件内容
            $mail->AltBody = "这是一封HTML格式的电子邮件。"; //附加信息，可以省略
            $mail->Send();
            if(empty($mail->ErrorInfo)) {
                $msg .= 'success';
            } else {
                $msg .= $mail->ErrorInfo;
            }
        } catch(Exception $e){
            $msg .= $e->getMessage();
        }
        return [
            'code' => 0,
            'msg' => $msg,
            'data' => null,
        ];
    }
}
