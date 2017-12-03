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
use yii\base\Model;

class WecharUserForm extends Model
{
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
}