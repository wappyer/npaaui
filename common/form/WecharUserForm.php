<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2017/12/3
 * Time: 下午3:56
 */
namespace common\form;

use common\base\ModelException;
use common\models\WechatUser;
use common\util\Http;
use yii\base\Model;

class WecharUserForm extends Model
{
    const errorMsg = "辰砂有点糊涂，下方小工具会提供您消息发送的正确姿势，如还存在问题欢迎留言。";

    //新增用户
    public static function createWechatUser($openId, $time)
    {
        $model = new WechatUser();
        $model->open_id = trim($openId);
        $model->create_time = (string)$time;
        $model->created_at = date('Y-m-d H:i:s', time());

        if ( ! $model->save()) {
            throw new ModelException($model);
        }
        return $model->id;
    }

    //收益计算
    public static function profit($message)
    {
        if (count($message) != 5) {
            return self::errorMsg;
        }
        $capital = $message[1]; //定投金额
        $interval = $message[2]; //定投周期
        $yearProfitRate = $message[3]; //预期年化收益率
        $year = $message[4]; //定投总时长(年)
//        $start = '2018-01-01';
//        $end = '2020-01-01';
//        $sumDay = (strtotime($end)-strtotime($start))/86400;
        $sumDay = $year*365;
        $cnt = $sumDay/$interval;
        $profitRate = $yearProfitRate/(365/$interval);
        $sum = 0;
        $sumCapital = 0;
        for ($i=$cnt; $i>0; $i--) {
            $sum += $capital*pow((1+$profitRate), $i);
            $sumCapital += $capital;
        }
        $sum = round($sum,2);
        $sumCapital = round($sumCapital,2);
        $sumProfit = $sum-$sumCapital;
        $content = "届时\n总资产: $sum\n总储蓄: $sumCapital\n总收益: $sumProfit";
        return $content;
    }

    //获取天气
    public static function weather($message)
    {
        $key = 'fhu6uudmkpsdwklo'; //key
        $uid = 'U4BDE80927'; //用户 ID
        $api = 'https://api.seniverse.com/v3/weather/daily.json'; // 接口地址
        $location = $message[1]; // 城市名称。除拼音外，还可以使用 v3 id、汉语等形式
        // 生成签名。文档：https://www.seniverse.com/doc#sign
        $param = [
            'ts' => time(),
            'ttl' => 300,
            'uid' => $uid,
        ];
        $sig_data = http_build_query($param); // http_build_query 会自动进行 url 编码
        // 使用 HMAC-SHA1 方式，以 API 密钥（key）对上一步生成的参数字符串（raw）进行加密，然后 base64 编码
        $sig = base64_encode(hash_hmac('sha1', $sig_data, $key, TRUE));
        // 拼接 url 中的 get 参数。文档：https://www.seniverse.com/doc#daily
        $param['sig'] = $sig; // 签名
        $param['location'] = $location;
        $param['start'] = 0; // 开始日期。0 = 今天天气
        $param['days'] = 3; // 查询天数，1 = 只查一天
        // 构造 url
        $url = $api . '?' . http_build_query($param);
        $ret = json_decode(Http::get($url), true);
        if (! isset($ret['results'])) {
            return self::errorMsg;
        }
        $daily = $ret['results'][0]['daily'];
        $content = '';
        $day = '';
        for ($i = 0; $i < 3; $i++) {
            $i != 0 || $day = '今天';
            $i != 1 || $day = '明天';
            $i != 2 || $day = '后天';
            $weather = $daily[$i]['text_day'];
            $temLow = $daily[$i]['low'];
            $temHigh = $daily[$i]['high'];
            $windD = $daily[$i]['wind_direction'];
            $windS = $daily[$i]['wind_scale'];
            $content .= "{$day}: {$weather} {$temLow}~{$temHigh}℃  {$windD}风{$windS}级";
            ($i == 0 || $i == 1) && $content .= "\n";
        }
        return $content;
    }
}