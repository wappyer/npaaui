<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2017/12/10
 * Time: 下午5:23
 */

namespace backend\controllers;


use common\base\BaseController;
use common\form\WecharUserForm;

class TestController extends BaseController
{
    public function actionWeather()
    {
        $ret = WecharUserForm::weather();
        return $this->renderMson($ret);
    }
}