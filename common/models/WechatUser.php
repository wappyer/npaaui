<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wechat_user".
 *
 * @property integer $id
 * @property string $open_id
 * @property string $username
 * @property string $sex
 * @property integer $status
 * @property string $create_time
 * @property string $created_at
 * @property string $updated_at
 */
class WechatUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['open_id', 'username', 'create_time'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'open_id' => '用户openId',
            'username' => '用户姓名',
            'sex' => '用户性别',
            'create_time' => '关注时间',
            'status' => '状态值',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}