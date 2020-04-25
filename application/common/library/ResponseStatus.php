<?php
namespace app\common\library;

class ResponseStatus
{
    const SUCCESS = 10000;
    const ERROR1 =  10001; //通用错误
    const ERROR2 =  10002;
    const ERROR3 =  10003;
    const ERROR4 =  10004;
    const ERROR5 =  10005;
    const HACK =  10006;
    const BAD_REQUEST = 10007;
    const NOT_LOGIN = 10100;
    const NOT_AUTH = 10200;
    const EXPIRED = 10300;
    const NOT_FOUND = 10400;
    const ADMIN_NOT_LOGIN = 20100;
}
