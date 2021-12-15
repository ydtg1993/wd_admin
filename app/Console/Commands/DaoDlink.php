<?php

namespace App\Console\Commands;

use App\Tools\RedisCache;
use App\Models\Movie;
use Illuminate\Console\Command;

class DaoDlink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DaoDlink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试导入磁链';

    protected $keyMovie     = 'moive_number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lists = $this->readExcel('./public/disklink_demo.csv',1,$lineSize);

        $movie = new Movie();
        foreach($lists as $v)
        {
            $mNumber    = trim($v[0]);    //番号
            $mName      = trim($v[1]);    //名称
            $mAddr      = trim($v[2]);    //地址
            $mMate      = trim($v[3]);    //文件信息
            $mTime      = trim($v[4]);    //更新日期
            $mHigh      = intval($v[5]);  //是否高清     is-small=1 是；
            $mSub       = intval($v[6]);  //是否含字幕   is-warning=1 是； 
            $mDown      = intval($v[7]);  //是否可下载   tooltip=1 是离线下载

            //少于8列，直接跳过
            if(count($v) < 8)
            {
                echo '跳过数据不全：'.$mNumber.PHP_EOL;
                continue;
            }

            //过滤不全的数据
            if(empty($mName) || empty($mNumber) || empty($mAddr))
            {
                echo '跳过缺失名称,番号,地址的数据:'.$mName.':'.$mNumber.PHP_EOL;
                continue;
            }

            //番号不存在的，直接跳过
            $mkey = base64_encode($mNumber);
            $mid = RedisCache::getSetScore($this->keyMovie,$mkey);
            if($mid == false)
            {
                echo '番号不存在的数据:'.$mName.':'.$mNumber.PHP_EOL;
                continue;
            }

            $arrLink =array();
            //读取磁链信息
            $arr = $movie->getFluxLink($mid);
            $nLink = intval($arr[0]->flux_linkage_num);
            if($nLink > 0)
            {
                $arrLink = json_decode($arr[0]->flux_linkage,true);
            }

            //整理数据
            $timeFormat = strtotime($mTime);

            $data = array();
            $data['name']       = $mName;
            $data['url']        = $mAddr;
            $data['meta']       = $mMate;
            $data['time']       = date('Y-m-d H:i:s',$timeFormat);
            $data['is-small']   = ($mHigh=='是')?1:2;
            $data['is-warning'] = ($mSub=='是')?1:2;
            $data['tooltip']    = ($mDown=='是')?1:2;

            //添加到数组中
            $arrLink[]=$data;

            //压缩数据
            $sLink = json_encode($arrLink);

            //更新数据表
            $movie->updateFluxLink($mid, count($arrLink), $sLink);

            echo '添加磁链：'.$mNumber.':'.$mName.PHP_EOL;
        }

        echo '本次导入执行完成'.PHP_EOL;

    }

    /**
     * 分页读取文件行数，每次50行
     * @param   string  $filePath   文件目录
     * @param   int     $line       从多少行开始读取，默认第0行
     */
    private function readExcel($filePath,$line=0,&$lineSize)
    {
        $res = array();
        //将文档按行读入内存
        $f = file( $filePath);
        $lineSize = count($f);

        //得到文件总行数
        $max = ($line+50>count($f))?count($f):$line+50;

        //遍历读取50行
        for($i=$line;$i<$max;$i++)
        {
            //读取一行,防止填入全半角符号
            $t = str_replace('；',';',$f[$i]);
            //按照英文逗号，切割
            $a = explode(',',$t);
            $res[]=$a;
        }
        unset($f);
        return $res;
    }
}
