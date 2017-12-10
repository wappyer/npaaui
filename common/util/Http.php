<?php

namespace common\util;

class Http
{
    public static function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
        //$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $return_content;
    }

    /**
     * @param $url
     * @param $paramArray
     * @param array $content_type
     * @return mixed
     */
    public static function curlPost($url, $paramArray, array $content_type = []){
        $ch = curl_init();
        if (empty($content_type)) {
            $header = [
                'Content-Type:application/json',
            ];

        } else {
            $header = $content_type;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($paramArray));// data是数组格式
        $result = curl_exec($ch);

        return $result;
    }
}