<?php

namespace Aven\WeMini;

use Aven\WeMini\Exception\WeException;
use GuzzleHttp\Client;

/**
 * Class WeMini
 *
 * @package \Aven\Wemini
 */
class WeMini
{
    private $appId;
    private $appSecret;
    private $code2session_url = "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code";
    private $sessionKey;


    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * 获取登录信息
     *
     * @author aven <aven.devlop@gmail.com>
     */
    public function getLoginInfo($code)
    {
        return $this->authCode2Session($code);
    }

    /**
     * 获取session_key && openid
     *
     * @author aven <aven.devlop@gmail.com>
     */
    private function authCode2Session($code)
    {
        $code2session_url = sprintf($this->code2session_url, $this->appId, $this->appSecret, $code);
        $httpClient = new Client;
        $response = $httpClient->request("GET", $code2session_url);
        $authInfo = json_decode($response->getBody(),true);
        if (!isset($authInfo['session_key'])) {
            if (isset($authInfo['errcode'])) {
                throw new WeException($authInfo['errmsg'], $authInfo['errcode']);
            } else {
                throw new WeException("failed to get session_key", 1000);
            }
        }

        $this->sessionKey = $authInfo['session_key'];

        return $authInfo;
    }

    /**
     * 解密获取用户敏感信息
     *
     * @author aven <aven.devlop@gmail.com>
     */
    public function getUserInfo($encryptedData, $iv)
    {
        return WeMiniHelper::decryptData($this->appId, $this->sessionKey, $encryptedData, $iv);
    }

}

