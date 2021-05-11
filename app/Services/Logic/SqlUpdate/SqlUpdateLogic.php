<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/11
 * Time: 16:55
 */

namespace App\Services\Logic\SqlUpdate;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SqlUpdateLogic
{
    protected static $namePath = 'App\\Services\\Logic\\SqlUpdate\\';

    //类型执行
    public static $typeClass = array(

    );

    /**
     * 初始化更新平台总库
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public static function initTable()
    {
        Log::info('开始初始化数据库！');
        $sqlTable = Sql::$sqlTable;
        foreach ($sqlTable as $value)
        {
            DB::statement($value);
        }
        Log::info('初始化数据库完成！');
    }


    /**
     * 历史更新
     */
    public static function upDateTable()
    {
        Log::info('开始处理历史调整主库调整！');
        //主库操作
        foreach (self::$typeClass as $k=>$v)
        {
            $runClassName = self::getClassName($k);
            if(!class_exists($runClassName))
            {
                continue;
            }
            else
            {
                $dbObj = new  $runClassName;
                //更新数据库
                try
                {
                    $dbObj->upDateTableDB();
                }
                catch (\Exception $e)
                {
                    Log::info('执行数据库出错！执行的类：'.$runClassName);
                }
            }
        }
        Log::info('历史调整数据库调整完成！');
    }

    private static function getClassName($type)
    {
        return  isset(self::$typeClass[$type]) ? self::$namePath.self::$typeClass[$type] : self::$namePath.'Base';
    }
}