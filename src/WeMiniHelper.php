<?php

namespace Aven\WeMini;

use Aven\WeMini\Exception\WeException;

/**
 * Class WeMiniHelper
 *
 * @package \Aven\Wemini
 */
class WeMiniHelper
{

    /**
     * 解析密文
     *
     * @param $encryptedData string 加密的用户数据
     * @param $iv            string 与用户数据一同返回的初始向量
     *
     *
     * @author aven <aven.devlop@gmail.com>
     */
    public static function decryptData($appId, $sessionKey, $encryptedData, $iv)
    {
        if (strlen($sessionKey) != 24) {
            throw new WeException("Failed to decrypt data", WeException::ILLEGAL_AES_KEY);
        }
        $aesKey = base64_decode($sessionKey);


        if (strlen($iv) != 24) {
            throw new WeException("Failed to decrypt data", WeException::ILLEGAL_IV);
        }
        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $result = self::prpDecrypt($aesKey, $aesCipher, $aesIV);

        list($code, $data) = $result;

        if ($code != 0) {
            throw new WeException("Failed to decrypt data", $code);
        }

        $dataObj = json_decode($result[1]);
        if ($dataObj == NULL) {
            throw new WeException("Failed to decrypt data", WeException::ILLEGAL_BUFFER);
        }
        if ($dataObj->watermark->appid != $appId) {
            throw new WeException("Failed to decrypt data", WeException::ILLEGAL_BUFFER);
        }

        return $data;
    }

    private static function prpDecrypt($aesKey, $aesCipher, $aesIV)
    {
        try {
            //解密
            $decrypted = openssl_decrypt($aesCipher, 'AES-128-CBC', $aesKey, OPENSSL_RAW_DATA, $aesIV);
        } catch (\Exception $e) {
            return [WeException::ILLEGAL_BUFFER, null];
        }

        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);

        } catch (\Exception $e) {
            return [WeException::ILLEGAL_BUFFER, null];
        }
        return [0, $result];
    }

}
