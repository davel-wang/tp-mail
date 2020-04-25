<?php
namespace app\common\exception;

use app\common\library\Utils;
use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use think\Log;

class Error extends Handle
{

    public function render(Exception $e)
    {
        Log::write('error:'.$e->getMessage().' at '.date('m-d H:i:s'));
        if(config('app_debug')) return parent::render($e);

        return Utils::error('error');
    }
}
