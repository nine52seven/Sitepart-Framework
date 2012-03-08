<?php
/**    
 *    writed by Chaing
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
     * generate active code
     *
     * @param integer $userid
     * @param string $email = null
     */
    public static function genActiveCode($userid, $email = null)
    {
        $encodeString = "3p#" . $userid . "#" . mt_rand() . "#" . time() . "#" . $email;
        return self::myEncode($encodeString);
    }
    
    /**
     * check active code
     *
     * @param string $value
     */
    public static function checkActiveCode($value) 
    {
        if (empty($value)) return false;
        $decodeString = self::myDecode($value);
        $section = explode("#", $decodeString);
        //$args = "3p#".$userId."#".$data['email']."#".time();
        if ($section[0] != "3p") {
            return false;
        }
        $now = time();
        if ($now - $section[3] > 60*60*24*7){
            return false;
        }
        $user = new User();
        if (!$user->getUserById($section[1])) {
            return false;
        } else {
            return $section;
        }
    }
    
    /**
     * generate invite code
     * 
     * format: "3p#" . $userid . "#" . time() . "#" . $email
     * $email optional
     *
     * @param integer $userid
     * @param string $email = null
     */
    public static function genInviteCode($userid, $email = NULL)
    {
        $encodeString = "3p#" . $userid . "#" . mt_rand() . "#" . time() . "#" . $email;
        return self::myEncode($encodeString);
    }
    
    /**
     * check invite code
     *
     * @param string $value
     */
    public static function checkInviteCode($value) 
    {
        if (empty($value)) return false;
        $decodeString = self::myDecode($value);
        $section = explode("#", $decodeString);
        if ($section[0] != "3p") {
            return false;
        }
        $user = new User();
        if (!$user->getUserById($section[1])) {
            return false;
        } else {
            return $section;
        }
    }
    
    //匹配文本中的url 用正则表达取出第一个url
    /**
     * parse to url and text
     *
     *
     */
    public static function parseTxt($txt) {
        $pattern = "/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i";
        if (preg_match_all($pattern, trim($txt), $url, PREG_SET_ORDER)) {
            $strTxt = preg_replace($pattern, "", $txt, 1);
            $return = array("url" => $url,"txt" => $strtxt);
            return $return;
        } else {
            return false;
        }

    }
    /**
     * parse to url and text via blank
     *
     * @param string $txt
     */
    public static function parseInput($txt)
    {
        $txt = preg_replace('/\r/', ' ', trim($txt));
        $txt = preg_replace('/\n/', ' ', trim($txt));
        $arrTxt = explode(" ", $txt, 2);
        $pattern = "/(?:(?:https?|ftp):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i";
        if (preg_match_all($pattern, trim($arrTxt[0]), $url, PREG_SET_ORDER)) {
            $return = array();
            $return['url'] = trim($arrTxt[0]);
            $return['txt'] = "";
            if (!empty($arrTxt[1])) {
                $return['txt'] = nl2br($arrTxt[1]);
            }
            $parseUrl = parse_url($return['url']);
            $return['domain'] = $parseUrl['host'];
            return $return;
        } else {
            return false;
        }
    }
    
    /**
     * parse tag
     *
     * @param string $txt
     */
    public static function parseTag($txt) 
    {
        $pattern = "/#.+?#/";
        if (preg_match_all($pattern, trim($txt), $tags)) {
            $return = array();
            foreach ($tags[0] as $key => $tag) {
                $return[] = str_replace('#', '', $tag);
            }
            return $return;
        } else {
            return false;
        }
    }
    
    /**
     * filter tag
     *
     * @param string $txt
     */
    public static function filterTag($txt) 
    {
        if ($txt == '') return $txt;
        $pattern = '/(#.+?#)/';
        $replacement = "<a href='http://lishilu.com/search?q=$1' target='_blank'>$1</a>";
        return preg_replace($pattern, $replacement, $txt);
    }

    /**
     * format userinfo
     *
     * @param array $userInfo
     */
    public static function formatUserInfo($userInfo)
    {
        $returnUserInfo = array();

        $returnUserInfo['id']               = $userInfo['id'];
        $returnUserInfo['name']             = $userInfo['name'];
        $returnUserInfo['username']         = $userInfo['username'];
        $returnUserInfo['profile_image_url'] = $userInfo['profile_image_url'] != '' ? $userInfo['profile_image_url'] : '/images/head.png';
        $returnUserInfo['create_time']      = $userInfo['create_time'];
        
        // coming soon ...
        $returnUserInfo['description']       = '';      // 个人描述           
        $returnUserInfo['url']               = '';      // 个人主页
        $returnUserInfo['protected']         = 'false'; // 是否是私有
        $returnUserInfo['followers_count']   = '123';   // 有多少followers
        $returnUserInfo['friends_count']     = '456';   // follow了多少人
        $returnUserInfo['favourites_count']  = '789';   // 收藏数量
        $returnUserInfo['following']         = 'false'; // 关系
        $returnUserInfo['lang']              = 'zh_CN'; // 语言编码

        return $returnUserInfo;
    }

    /**
     * format note info
     *
     * @param array $note
     */
    public static function formatNote($note)
    {
        $returnNote = array();
        $returnNote['id'] = $note['id'];
        $returnNote['text'] = $note['text'];
        $returnNote['url_id'] = $note['url_id'];
        if (key_exists('url_string', $note)) {
            $returnNote['url_string'] = $note['url_string'];
            $returnNote['short_url_string'] = PubFunc::shortUrl($note['url_string']);
        }
        $returnNote['create_time'] = PubFunc::getLocalDate("Y-m-d H:i:s", $note['create_time'], "Asia/Shanghai");
        $returnNote['in_repost_to_note_id']  = $note['relate_note_id'];
        
        $returnNote['user'] = PubFunc::formatUserInfo($note['user']);
        
        return $returnNote;
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
     * veses.com shorten url
     * 
     * @param $url
     * @return string $shorturl
     */
    public static function shortUrl($url)
    {
        if ($url == '') return $url;
        $api = "http://veses.com/Index?api=lishilu.com&url=";
        $shorturl = file_get_contents($api.$url);
        $shorturl = preg_replace('/\r/', '', trim($shorturl));
        $shorturl = preg_replace('/\n/', '', trim($shorturl));
        if ($shorturl != "" and strlen($shorturl) <= 40) {
            return $shorturl;
        } else {
            return $url;
        }
    }

    /**
     * log
     *
     * @param string $message
     */
    public static function log($message)
    {
        $config = Zend_Registry::get('config');
        $logMessage  = '['.date("Y-m-d h:i:s: ").'] ';
        $logMessage .= $message;
        file_put_contents($config->log->file, $logMessage."\n", FILE_APPEND);
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
    
    /**
     * mail
     *
     *
     */
    public static function email($toEmail, $mailSubject, $mailBody)
    {
        $config = Zend_Registry::get('config');
        $signupUrl  = $config->mail->signupUrl;
        $mailServer = $config->mail->mailserver;
        $mailParams = $config->mail->smtp->toArray();
        $mailNote   = $config->mail->mailNote;
        $mailFrom   = $config->mail->mailFrom;
        $mailBody .= '<br/><br/><br/> threepoints 小组 ' . date("Y-m-d");
        $transport = new Zend_Mail_Transport_Smtp($mailServer, $mailParams);
        $mail = new Zend_Mail('utf-8');
        $mail->setBodyHtml($mailBody)
            ->setFrom($mailParams['username'], $mailFrom)
            ->addTo($toEmail)
            ->setSubject($mailSubject)
            ->send($transport);
        return true;
    }
    
    /**
     * return head picture path
     *
     *
     */
    public static function getProfileImage($userid, $format = 'jpg')
    {
        if ($userid <1000) {
            return PubFunc::getProfileBasepath() . 'ph_' . $userid . '.' . $format;
        } else {
            return PubFunc::getProfileBasepath() . 'ph_' . $userid . '.' . $format;
        }
    }
    public static function getProfileImageUrl($userid, $format = 'jpg')
    {
        if (!$userid) {
            return 'http://lishilu.com/profile_head/head.png';
        } else {
            return 'http://lishilu.com/profile_head/ph_' . $userid . '.' . $format;
        }
    }
    public static function getProfileImagePath($userid)
    {
        $p = $userid - $userid % 1000;
        return PubFunc::getProfileBasepath() . $p . '/';
    }
    public static function getProfileBasepath()
    {
        return '/www/sitepart.net/threepoints/html/profile_head/';
    }
}

