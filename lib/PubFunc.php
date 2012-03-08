<?php
/**    
 *  writed by Chaing
 *  存放公共函数
 */

class PubFunc
{   
    

    /**
     * encode string
     *
     * @param string $value
     */
    public static function myEncode($value)
    {
        return urlencode(Base64_encode(trim($value)));
    }

    /**
     * decode string
     *
     * @param string $value
     */
    public static function myDecode($value) 
    {
        return urldecode(base64_decode(trim($value)));
    }

    /**
     * google shorten url
     * 
     * @param string $url
     * @return string $url
     */
    public static function shortUrl1($url)
    {
        $api = "http://ggl-shortener.appspot.com/?url=";
        $file = file_get_contents($api.$url);
        $temp = json_decode($file);
        //print_r($temp);
        if (isset($temp->short_url)) {
            return $temp->short_url;
        } else {
            return false;
        }
    }

    /**
     * get client ip
     *
     * @return string $ip
     */
    public static function getIP()
    { 
        if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
            $ip = getenv("HTTP_CLIENT_IP"); 
        elseif(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
            $ip = getenv("REMOTE_ADDR"); 
        elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
            $ip = $_SERVER['REMOTE_ADDR']; 
        else 
            $ip = "0.0.0.0"; 
        
        return $ip;
    }
    
    //验证email地址,并且可以选择检查邮件域所属 DNS 中的 MX 记录
    public static function is_valid_email($email, $test_mx = false)
    {
        if(eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
        {
            if($test_mx) {
                list($username, $domain) = split("@", $email);
                return getmxrr($domain, $mxrecords);
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    
    public static function getMicrotime()
    {
        return floor((float)microtime(true)*1000);
    }

    /**
     * 转换时间戳为当地时间
     *
     * @param $format   eg: Y-m-d H:i:s
     * @param $timezone 毫秒
     * @param $timezoneId
     * @return 
     */    
    public static function getLocalDate($format, $timestamp, $timezoneId = NULL)
    {
        $default_timezone = date_default_timezone_get();
        date_default_timezone_set( ($timezoneId?$timezoneId:$default_timezone) );
        $date = date($format, $timestamp/1000);
        date_default_timezone_set($default_timezone);
        return $date;
    }

    /**
     * Returns the default HTTP status message for the given code.
     * 
     * @param integer $code
     * @throws Exception
     */
    public static function getHttpStatus( $code = 200 )
    {
        $httpStatusMessages = array(
                            100 => 'Continue',
                            101 => 'Switching Protocols',
                            200 => 'OK',
                            201 => 'Created',
                            202 => 'Accepted',
                            203 => 'Non-Authoritative Information',
                            204 => 'No Content',
                            205 => 'Reset Content',
                            206 => 'Partial Content',
                            300 => 'Multiple Choices',
                            301 => 'Moved Permanently',
                            302 => 'Moved Temporarily',
                            303 => 'See Other',
                            304 => 'Not Modified',
                            305 => 'Use Proxy',
                            306 => 'Unused',
                            307 => 'Temporary Redirect',
                            400 => 'Bad Request',
                            401 => 'Unauthorized',
                            402 => 'Payment Required',
                            403 => 'Forbidden',
                            404 => 'Not Found',
                            405 => 'Method Not Allowed',
                            406 => 'Not Acceptable',
                            407 => 'Proxy Authentication Required',
                            408 => 'Request Time-out',
                            409 => 'Conflict',
                            410 => 'Gone',
                            411 => 'Length Required',
                            412 => 'Precondition Failed',
                            413 => 'Request Entity Too Large',
                            414 => 'Request-URI Too Large',
                            415 => 'Unsupported Media Type',
                            416 => 'Requested Range Not Satisfiable',
                            417 => 'Expectation Failed',
                            500 => 'Internal Server Error',
                            501 => 'Not Implemented',
                            502 => 'Bad Gateway',
                            503 => 'Service Unavailable',
                            504 => 'Gateway Time-out',
                            505 => 'HTTP Version not supported'
                        );
        if(array_key_exists($code, $httpStatusMessages))
            return $httpStatusMessages[$code];
        else
            throw new Exception('Invalid HTTP status code: ' . code);
    }
    
}

