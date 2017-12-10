<?php

namespace common\base;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class BaseFkController extends Controller
{

    private $params = null;
    private $rawParams = null;

    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }

    public function getParam($name, $skipOnEmpty = true, $default = NULL, $rule = false)
    {
        $params = Yii::$app->request->get();
        if (isset($params[$name])) {
            if ('safe' === $rule) {
                if (empty($params[$name])) {
                    return $default;
                }
            }
            return $params[$name];

        } elseif ($skipOnEmpty == false) {
            throw New BaseException(BaseException::REQUIRED_PARAM_NOT_PROVIDED,$name, $name);
        }
        return $default;
    }
    public function renderJson($data)
    {
        print(Json::encode($data));
    }

    public function renderMson($params = [])
    {
        $ret = [];
        $ret['success'] = true;
        $ret['result'] = $params;
        $ret['errors'] = [];
        return $this->renderJson($ret);
    }
    
    public function getExtParams()
    {
        if (null == $this->rawParams) {
            //parse_str($this->getRawData(),$params);
            $params = json_decode($this->getRawData(), true);
            if (NULL === $params) {
                throw New BaseException(BaseException::INVALID_JSON_EXP);
            }
            $this->rawParams = $params;
        }
        return $this->rawParams;
    }

    public function getRawData()
    {
        $data = file_get_contents("php://input");
        return $data;
    }

    public function getJsonParam($name)
    {
        $jsonParamUrlEncoded = $this->getParam($name);
        $jsonParam = urldecode($jsonParamUrlEncoded);
        $param = json_decode($jsonParam, true);
        return (array)$param;
    }

    public function getJsonExtParam($name)
    {
        $jsonParamUrlEncoded = $this->getExtParam($name);
        $jsonParam = urldecode($jsonParamUrlEncoded);
        $param = json_decode($jsonParam, true);
        return (array)$param;
    }

    public function getJsonRawData()
    {
        $data = file_get_contents("php://input");
        $json_data = json_decode($data, true);
        if (!empty($data) && is_null($json_data)) {
            throw new \Exception();
        }
        return $json_data;
    }

    public function getExtParam($name = null, $skipOnEmpty = true, $default = null){
        Yii::$app->response->format = 'json';
        if (is_null($name)) {
            throw New BaseException(BaseException::REQUIRED_PARAM_NOT_PROVIDED,$name, $name);
        }
        $params = $this->getExtParams();
        if (!isset($params[$name]) &&
            true === $skipOnEmpty) {
            return $default;
        } elseif (!isset($params[$name]) &&
            false === $skipOnEmpty) {
            throw New BaseException(BaseException::REQUIRED_PARAM_NOT_PROVIDED,$name." is required");
    }
        //error_log(var_export($params,true));
        //error_log($name);
        return $params[$name];
    }

    public function render($view, $params = [])
    {
        $request = Yii::$app->request;
        $flag = $this->getParam('whoisyourdaddy');
        if ($flag) {
            print(Json::encode($params));
            exit;
        }
        return parent::render($view, $params);
    }

}
