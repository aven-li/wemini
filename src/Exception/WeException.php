<?php

namespace Aven\WeMini\Exception;
/**
 * Class WeException
 *
 * @package \\${NAMESPACE}
 */
class WeException extends \Exception
{
    const WE_OK = 0;
    const ILLEGAL_AES_KEY = -41001;
    const ILLEGAL_IV = -41002;
    const ILLEGAL_BUFFER = -41003;
    const DECODE_BASE64_ERROR = -41004;
}
