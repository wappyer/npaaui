<?php
/*
 * author:yeyanchao@heqiauto.com
 */
namespace common\base;

use Yii;
use yii\base\Exception;

class BaseException extends Exception
{
    protected $errorMessage = NULL;
    protected $errorCode = NULL;
    protected $params = [];

    const CODE_SERVER_ERROR = 500;
    const INVALID_INPUT_EXP = 5002;
    const EXIST_INPUT_EXP = 5003;
    const DELETE_ILLEGAL = 5004;
    const REQUIRED_PARAM_NOT_PROVIDED = 5005;
    const PRIVATE_MODEL_CLASS_NOT_SET = 5006;
    const INVALID_JSON_EXP = 5007;
    const AUTH_FAILED_USER_NOT_EXISTS = 5008;
    const AUTH_FAILED_INVALID_SIGNATURE = 5009;
    const AUTH_FAILED_INVALID_NONCE  = 5010;


    //part category
    const PART_CATEGORY_DELETE_NEED_CATEGORY_ID = 5100;
    const PART_CATEGORY_DELETE_HAS_CHILDREN = 5101;
    const PART_CATEGORY_UPDATE_NEED_CATEGORY_ID = 5102;
    const PART_CATEGORY_END_FORBID_ADD_SUBNODE = 5103;
    const PART_CATEGORY_CAT_NAME_DUPLICATED = 5104;
    const PART_CATEGORY_REQUIRE_CATEGORY_ID = 5105;
    const PART_CATEGORY_MODEL_NOT_FOUND = 5106;
    const PART_CATEGORY_IS_NOT_END = 5107;
    const PART_CATEGORY_HAS_RELATED_BRAND = 5108;
    const PART_CATEGORY_NAME_ALIAS_DUPLICATED = 5109;
    const PART_CATEGORY_ALIAS_DUPLICATED = 5110;
    const PART_CATEGORY_SUITS_DUPLICATED = 5111;
    const PART_CATEGORY_SUITS_CHILD_NOT_SUIT = 5112;
    const PART_CATEGORY_UNIT_IS_USED = 5113;
    const PART_CATEGORY_CODE_IS_NOT_EXIST = 5114;


    //part
    const PART_PARAM_REQUIRED = 5120;
    const PART_PMANU_CODE_DUPLICATED = 5121;
    const PART_HAS_PART_SUIT_RELATE = 5122;
    const PART_NAME_DUPLICATED = 5123;
    const SUIT_PART_RELATE_DUPLICATED = 5124;
    const PART_PN_CODE_INVALID = 5125;

    //property & value
    const PROPERTY_NAME_DUPLICATED = 5160;
    const PROPERTY_IS_REFERED = 5161;
    const PROPERTY_PARAM_INVALID = 5162;
    const PROPERTY_VALUE_DUPLICATED = 5163;
    const PROPERTY_CONSTRAIN_FORMAT_NOT_JSON = 5164;
    const PROPERTY_CONSTRAIN_CONTENT_INVALID = 5165;
    const PROPERTY_VALUE_IS_OCCUPIED = 5166;

    //part index
    const PART_INDEX_DUPLICATED = 5180;
    const PART_INDEX_GROUP_INVALID = 5181;

    //part ext
    const PART_EXT_PARAMS_INVALID = 5200;
    const PART_EXT_REMOVE_FAIL = 5201;

    //car-model-part fit
    const PART_CAR_MODEL_FIT_REMOVE_FAIL = 5220;

    //文件上传错误码
    const SEND_EMAIL_FAILED = 5300;
    const FILE_UPLOAD_FAILED = 5301;
    const FILE_ALREADY_EXIST = 5302;
    const FILE_SAVE_FAILED = 5304;
    const FILE_OUT_RANGE = 5305;
    const DATA_SAVE_FAILED = 5306;

    //权限
    const ACTION_NOT_ALLOW = 5400;

    //用户
    const GET_USER_INFO_ERROR = 5500;
    const USER_DING_EXISTS = 5501;
    const USER_DING_NOT_EXISTS = 5502;

    //vin图片识别
    const NOT_SUPPORT_IMAGE_TYPE = 5616;
    const NOT_SUPPORT_CARD_TYPE = 5617;
    const JSON_FORMAT_ERROR = 5618;
    const RECOGNIZE_FALSE = 5619;
    const PRODUCT_ID_ERROR = 5620;
    const AUTHORIZATION_ERROR = 5621;
    const INPUT_PARAMS_ERROR = 5627;
    const SERVER_GET_FILE_ERROR = 5628;
    const BASE64_ERROR = 5629;
    const NUMBER_OF_VIN_REQUEST_LIMITED = 5630;
    const VIN_INVALID = 5631;
    const IMAGE_FILE_NOT_FOUND = 5632;

    //carModel
    const CAR_MODEL_VIN_DUPLICATED = 5601;
    const CAR_MODEL_VIN_EMPTY = 5602;
    const IS_RELEASED = 5603;
    const UN_RELEASED = 5604;
    const IS_RELEASED_DUPLICATED = 5605;

    //api
    const API_ACCESS_EXCEPTION = 5700;
    const UNAUTHORIZED_RESOURCE = 5701;
    const NUMBER_OF_REQUEST_LIMITED = 5702;
    const RATE_LIMIT_EXCEEDED = 5703;
    const API_ERROR = 5704;
    const ACCESS_TOKEN_TIME_OUT = 5705;
    const ACCESS_TOKEN_NOT_EXISTS = 5706;

    //code
    const CODE_VALID = 5800;

    //part replacement
    const PART_EXISTS_REPLACE_GROUP = 5900;


    protected static $exceptions = [
        self::CODE_SERVER_ERROR => 'internal server error',
        self::INVALID_INPUT_EXP => 'Input param(s) is(are) invalid',
        self::EXIST_INPUT_EXP => 'Input param(s) is(are) exist',
        self::DELETE_ILLEGAL => 'Delete is illegal',
        self::REQUIRED_PARAM_NOT_PROVIDED => 'REQUIRED_PARAM_NOT_PROVIDED',
        self::PRIVATE_MODEL_CLASS_NOT_SET => 'Please set private model-class name first',
        self::INVALID_JSON_EXP => 'Not Valid Json:Please check input format',
        self::AUTH_FAILED_USER_NOT_EXISTS => 'Auth failed: user not exists',
        self::AUTH_FAILED_INVALID_SIGNATURE => 'Auth failed: Signature is invalid',
        self::AUTH_FAILED_INVALID_NONCE  => 'Auth failed: Nonce is invalid',

        //part category
        self::PART_CATEGORY_DELETE_NEED_CATEGORY_ID => 'Delete category: require category_id',
        self::PART_CATEGORY_DELETE_HAS_CHILDREN => 'Delete category: has children',
        self::PART_CATEGORY_UPDATE_NEED_CATEGORY_ID => 'Delete category: require category_id',
        self::PART_CATEGORY_END_FORBID_ADD_SUBNODE => 'Forbid add subnode to end node',
        self::PART_CATEGORY_CAT_NAME_DUPLICATED => 'Category name duplicated',
        self::PART_CATEGORY_REQUIRE_CATEGORY_ID => 'Require category id',
        self::PART_CATEGORY_MODEL_NOT_FOUND => 'Category model not found',
        self::PART_CATEGORY_IS_NOT_END => 'Part category is NOT end',
        self::PART_CATEGORY_HAS_RELATED_BRAND => 'Part category has related brands',
        self::PART_CATEGORY_NAME_ALIAS_DUPLICATED => "part category name alias duplicated",
        self::PART_CATEGORY_ALIAS_DUPLICATED => "part category alias duplicated",
        self::PART_CATEGORY_SUITS_DUPLICATED => "part category suits duplicated",
        self::PART_CATEGORY_SUITS_CHILD_NOT_SUIT => "part category suits child not suit",
        self::PART_CATEGORY_UNIT_IS_USED => "part category unit is used",
        self::PART_CATEGORY_CODE_IS_NOT_EXIST => "the code of part category is not exist",

        //part
        self::PART_PARAM_REQUIRED => 'Missing required params',
        self::PART_PMANU_CODE_DUPLICATED => 'part manu code duplicated',
        self::PART_HAS_PART_SUIT_RELATE => 'part has part suit relate',
        self::PART_NAME_DUPLICATED => 'part name duplicated',
        self::SUIT_PART_RELATE_DUPLICATED => 'suit part relate duplicated',
        self::PART_PN_CODE_INVALID => 'part pn code invalid',

        //property
        self::PROPERTY_NAME_DUPLICATED => 'property name is duplicated',
        self::PROPERTY_IS_REFERED => 'Property is referred',
        self::PROPERTY_PARAM_INVALID => 'Param value is invalid',
        self::PROPERTY_VALUE_DUPLICATED => 'Property value duplicated',
        self::PROPERTY_CONSTRAIN_FORMAT_NOT_JSON => 'Property constrain not json',
        self::PROPERTY_CONSTRAIN_CONTENT_INVALID => 'Property constrain content invalid',
        self::PROPERTY_VALUE_IS_OCCUPIED => 'Property value is occupied, check PartExt',
        //index
        self::PART_INDEX_DUPLICATED => 'Part index duplicated',
        self::PART_INDEX_GROUP_INVALID => 'Part index group is invalid',

        //part ext
        self::PART_EXT_PARAMS_INVALID => 'Part ext params is invalid',
        self::PART_EXT_REMOVE_FAIL => 'Part ext remove faile due to db fail',

        //part carmodel fit 
        self::PART_CAR_MODEL_FIT_REMOVE_FAIL => 'Part fit record remove faile due to db fail',

        //文件上传
        self::SEND_EMAIL_FAILED => "发送邮件失败",
        self::FILE_UPLOAD_FAILED => "文件上传错误",
        self::FILE_ALREADY_EXIST => "文件已存在",
        self::FILE_SAVE_FAILED => "文件保存失败",
        self::FILE_OUT_RANGE => "导入数据超出限制",
        self::DATA_SAVE_FAILED => "数据导入失败",

	    //权限
        self::ACTION_NOT_ALLOW => "You are not allowed to perform this action.",

        self::GET_USER_INFO_ERROR => "Get user info error.",
        self::USER_DING_EXISTS => "该钉钉账号已绑定.",
        self::USER_DING_NOT_EXISTS => "该帐号未绑定.",

        //vin识别
        self::NOT_SUPPORT_IMAGE_TYPE => "不支持的图像类型.",
        self::NOT_SUPPORT_CARD_TYPE => "不支持的卡片类型.",
        self::JSON_FORMAT_ERROR => "Json格式化错误",
        self::RECOGNIZE_FALSE => "Recognize false",
        self::AUTHORIZATION_ERROR => "第三方授权错误.",
        self::INPUT_PARAMS_ERROR => "输入的参数有误.",
        self::SERVER_GET_FILE_ERROR => "服务器接收文件流异常.",
        self::PRODUCT_ID_ERROR => "非授权的产品型号.",
        self::BASE64_ERROR => 'BASE64 error',
        self::NUMBER_OF_VIN_REQUEST_LIMITED => 'The number of vin-requests is limited.',
        self::VIN_INVALID => 'The number of vin is invalid',
        self::IMAGE_FILE_NOT_FOUND => 'Empty image',

        //carModel
        self::CAR_MODEL_VIN_DUPLICATED => "Car Model vin duplicated",
        self::CAR_MODEL_VIN_EMPTY => "Car Model vin empty",
        self::IS_RELEASED => "Car Model is released",
        self::UN_RELEASED => "Car Model is not released",
        self::IS_RELEASED_DUPLICATED => "Car Model is released duplicated",

        //api
        self::API_ACCESS_EXCEPTION => "api access exception.",
        self::UNAUTHORIZED_RESOURCE => "Not allowed to perform this unauthorized resource.",
        self::NUMBER_OF_REQUEST_LIMITED => 'Not allowed to perform this resource, the number of requests is limited.',
        self::RATE_LIMIT_EXCEEDED => 'Rate limit exceeded.',
        self::API_ERROR => 'Api error',
        self::ACCESS_TOKEN_TIME_OUT => 'Access Token is timeout',
        self::ACCESS_TOKEN_NOT_EXISTS => 'Access Token is not exists',

        //code
        self::CODE_VALID => 'code valid',

        //part replacement
        self::PART_EXISTS_REPLACE_GROUP => 'The part is exists replace group',

    ];

    protected static $chineseExceptions = [
        self::CODE_SERVER_ERROR => '内部服务器错误',
        self::INVALID_INPUT_EXP => '输入的参数无效',
        self::EXIST_INPUT_EXP => '输入的参数不存在',
        self::DELETE_ILLEGAL => '不可删除',
        self::REQUIRED_PARAM_NOT_PROVIDED => '必填参数不能为空',
        self::PRIVATE_MODEL_CLASS_NOT_SET => '请先设置类名',
        self::INVALID_JSON_EXP => '无效的JSON: 请检查输入格式',
        self::AUTH_FAILED_USER_NOT_EXISTS => '认证失败: 用户不存在',
        self::AUTH_FAILED_INVALID_SIGNATURE => '认证失败：签名无效',
        self::AUTH_FAILED_INVALID_NONCE  => '认证失败：NONCE无效',

        //part category
        self::PART_CATEGORY_DELETE_NEED_CATEGORY_ID => '删除失败: 目录不能为空',
        self::PART_CATEGORY_DELETE_HAS_CHILDREN => '删除失败: 含有子目录',
        self::PART_CATEGORY_UPDATE_NEED_CATEGORY_ID => '更新失败: 目录不能为空',
        self::PART_CATEGORY_END_FORBID_ADD_SUBNODE => '禁止给节点添加子节点',
        self::PART_CATEGORY_CAT_NAME_DUPLICATED => '已存在的配件目录',
        self::PART_CATEGORY_REQUIRE_CATEGORY_ID => '目录不能为空',
        self::PART_CATEGORY_MODEL_NOT_FOUND => '该数据不存在',
        self::PART_CATEGORY_IS_NOT_END => '配件品类不能是目录',
        self::PART_CATEGORY_HAS_RELATED_BRAND => '非法删除：请先删除该品类下关联品牌',
        self::PART_CATEGORY_NAME_ALIAS_DUPLICATED => "该别名存在相同品类名",
        self::PART_CATEGORY_ALIAS_DUPLICATED => "该别名已存在",
        self::PART_CATEGORY_SUITS_DUPLICATED => "该品类已添加",
        self::PART_CATEGORY_SUITS_CHILD_NOT_SUIT => "套装下不能包含套装",
        self::PART_CATEGORY_UNIT_IS_USED => "单位已被配件关联，请勿删除",
        self::PART_CATEGORY_CODE_IS_NOT_EXIST => "品类编码不存在，请先添加品类编码",

        //part
        self::PART_PARAM_REQUIRED => '必填参数不能为空',
        self::PART_PMANU_CODE_DUPLICATED => '该出厂编码已存在',
        self::PART_HAS_PART_SUIT_RELATE => '非法删除:该配件存在与套装配件的关联关系',
        self::PART_NAME_DUPLICATED => '配件名称已存在',
        self::SUIT_PART_RELATE_DUPLICATED => '套装配件关联配件重复',
        self::PART_PN_CODE_INVALID => '无效的配件编码',

        //property
        self::PROPERTY_NAME_DUPLICATED => '该属性名称已存在',
        self::PROPERTY_IS_REFERED => '该属性已存在',
        self::PROPERTY_PARAM_INVALID => '无效的属性值',
        self::PROPERTY_VALUE_DUPLICATED => '属性值已存在',
        self::PROPERTY_CONSTRAIN_FORMAT_NOT_JSON => '单位格式错误',
        self::PROPERTY_CONSTRAIN_CONTENT_INVALID => '无效的单位',
        self::PROPERTY_VALUE_IS_OCCUPIED => '在使用的属性值, 请检查配件拓展信息',
        //index
        self::PART_INDEX_DUPLICATED => '已存在的查询码',
        self::PART_INDEX_GROUP_INVALID => '请填写正确的厂商',

        //part ext
        self::PART_EXT_PARAMS_INVALID => '请填写有效的拓展参数',
        self::PART_EXT_REMOVE_FAIL => '配件拓展删除失败: 数据库错误',

        //part carmodel fit
        self::PART_CAR_MODEL_FIT_REMOVE_FAIL => '适配车型删除失败: 数据库错误',

        //文件上传
        self::SEND_EMAIL_FAILED => "发送邮件失败",
        self::FILE_UPLOAD_FAILED => "文件上传错误",
        self::FILE_ALREADY_EXIST => "文件已存在",
        self::FILE_SAVE_FAILED => "文件保存失败",
        self::FILE_OUT_RANGE => "导入数据超出限制",
        self::DATA_SAVE_FAILED => "数据导入失败",

	    //权限
	    self::ACTION_NOT_ALLOW => "您无权限进行该操作，请联系管理员",

        //用户
        self::GET_USER_INFO_ERROR => "获取用户信息失败",
        self::USER_DING_EXISTS => "该钉钉账号已绑定.",
        self::USER_DING_NOT_EXISTS => "该帐号未绑定.",

        //vin识别
        self::NOT_SUPPORT_IMAGE_TYPE => "不支持的图像类型.",
        self::NOT_SUPPORT_CARD_TYPE => "不支持的卡片类型.",
        self::JSON_FORMAT_ERROR => "Json格式化错误",
        self::RECOGNIZE_FALSE => "识别失败.",
        self::AUTHORIZATION_ERROR => "第三方授权错误.",
        self::INPUT_PARAMS_ERROR => "输入的参数有误.",
        self::SERVER_GET_FILE_ERROR => "服务器接收文件流异常.",
        self::PRODUCT_ID_ERROR => "非授权的产品型号.",
        self::BASE64_ERROR => 'BASE64编码错误',
        self::NUMBER_OF_VIN_REQUEST_LIMITED => 'vin查询次数到达上限',
        self::VIN_INVALID => 'VIN号校验失败，请提供正确的VIN',
        self::IMAGE_FILE_NOT_FOUND => '文件不存在',

        //carModel
        self::CAR_MODEL_VIN_DUPLICATED => "该vin已绑定车型",
        self::CAR_MODEL_VIN_EMPTY => "该vin未搜索到结果",
        self::IS_RELEASED => "该车型已发布",
        self::UN_RELEASED => "该车型未发布",
        self::IS_RELEASED_DUPLICATED => "不可发布重复车型",

        //api
        self::API_ACCESS_EXCEPTION => "api access exception.",
        self::UNAUTHORIZED_RESOURCE => "Not allowed to perform this unauthorized resource.",
        self::NUMBER_OF_REQUEST_LIMITED => 'Not allowed to perform this resource, the number of requests is limited.',
        self::RATE_LIMIT_EXCEEDED => 'Rate limit exceeded.',
        self::API_ERROR => 'Api error',
        self::ACCESS_TOKEN_TIME_OUT => 'Access Token is timeout',
        self::ACCESS_TOKEN_NOT_EXISTS => 'Access Token is not exists',

        //code
        self::CODE_VALID => '编码非法',

        //part replacement
        self::PART_EXISTS_REPLACE_GROUP => '该配件已存在替换组',

    ];

    public function __construct($errorCode = NULL, $errorMessage = NULL, $params = [])
    {
        if (property_exists(Yii::$app->response, 'format')) {
            Yii::$app->response->format = 'json';
        }
        $errorCode = (int)$errorCode;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage ? $errorMessage : $this->getErrorMessageByErrorCode($errorCode);

        if (is_array($params)) {
            $this->params = $params;

        } else {
            $this->params = [$params];
        }
        $this->_log();
        parent::__construct($this->errorMessage, $this->errorCode);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getParams()
    {
        return $this->params;
    }

    public static function getErrorMessageByErrorCode($code = NULL, $type = false)
    {
        if (!$type) {
            return isset(self::$chineseExceptions[(int)$code]) ? self::$chineseExceptions[(int)$code] : NULL;
        } else {
            return isset(self::$exceptions[(int)$code]) ? self::$exceptions[(int)$code] : NULL;
        }
    }

    public function _log()
    {
        error_log("$this->file#$this->line|$this->errorCode|".self::getErrorMessageByErrorCode($this->errorCode, true)."|params:".json_encode($this->params));
    }
}
