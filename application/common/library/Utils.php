<?php
namespace app\common\library;

class Utils{
    static function error($msg='',$code=0) {
        if(!$code) $code = ResponseStatus::ERROR1;
        if(!$msg) $msg = 'operation_failed';

        return json([
            'code' => $code,
            'msg' => $msg,
            'result' => null,
        ]);
    }

    static function success($result=null,$msg='',$code=0) {
        if(!$code) $code = ResponseStatus::SUCCESS;
        if(!$msg) $msg = 'operation_success';

        return json([
            'code' => $code,
            'msg' => $msg,
            'result' => $result,
        ]);
    }

    static function html($msg) {
        return '<html><head><title>error</title></head><body></body>'.$msg.'</html>';
    }
}
