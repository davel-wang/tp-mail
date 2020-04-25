<?php
namespace app\cli\controller;

use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\Db;
use think\Exception;
use think\Log;

class Test extends Command
{
    protected function configure(){
        $this->setName('Test')->setDescription('This is a Test');
    }

    protected function execute(Input $input, Output $output){
        ini_set('memory_limit','-1');
        config('database.break_reconnect',true);
        \think\Request::instance()->module('cli');

        Log::write('Test start');
        $this->doRun();
    }

    private function doRun() {

    }
}
