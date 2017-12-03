<?php
/*
 * author:yeyanchao@heqiauto.com
 */
namespace common\base;

use Yii;
use common\base\BaseException;

class ModelException extends BaseException
{

    const Model_ERROR = 5001;

    public function __construct($model)
    {
        if (!$model) {
            $this->errorMessage = "Exception:Model not found";
            parent::__construct(self::Model_ERROR, $this->errorMessage);
        } else {
            $this->errorMessage = 'Exception:'.get_class($model)." save exp";
            parent::__construct(self::Model_ERROR, $this->errorMessage, $model->errors);
        }
    }
}
