<?php

namespace App\Models;

use App\Services\Logic\RedisCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MovieLog extends Model
{
    protected $table = 'movie_log';

    const UPDATED_AT = null;

    public static function getRankingVersion($type,$time)
    {
        $reData = ['list' => [], 'sum' => 0];
        $log = new MovieLog();
        $type > 0 ? ($log = $log->where('cid', $type)) : null;
        if ($time > 0) {
            $time == 1 ? ($log = $log->whereBetween('created_at',[
                date('Y-m-d 00:00:00', strtotime("-1 days")),
                date('Y-m-d 00:00:00', time())
            ])) : null;
            $time == 2 ? ($log = $log->where('created_at', '>=', (date('Y-m-d 00:00:00', strtotime('-' . (date('w', time()) - 1) . ' days', time()))))) : null;
            $time == 3 ? ($log = $log->where('created_at', '>=', date('Y-m-01 00:00:00', time()))) : null;
        }
        $log = $log->selectRaw('count(mid) as num,mid')->groupBy('mid');

        $reData['sum'] = $log->offset(0)->limit(100)->get()->count();
        $browseList = $log->orderBy('num', 'desc')->offset(0)->limit(100)->get()->pluck('mid')->toArray();

        if (is_array($browseList) || count($browseList) > 0) {
            $MovieList = Movie::whereIn('id', $browseList)->get();
            $tempMovie = [];

            foreach ($MovieList as $val) {
                $data = Movie::formatList($val);//格式化视频数据
                $data['score_people'] = $val['score_people'];
                $data['wan_see'] = $val['wan_see'];
                $data['seen'] = $val['seen'];
                $data['pv'] = DB::table('movie_log')->where('mid', $val['id'])->count();
                $tempMovie[$val['id'] ?? 0] = $data;
            }
            $rank = 0;
            foreach ($browseList as $val) {
                $rank++;
                $temp = $tempMovie[$val] ?? [];
                $temp['rank'] = $rank;
                $reData['list'][] = $temp;
            }
        }

        return $reData;
    }
}
