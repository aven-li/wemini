<?php

/*
|--------------------------------------------------------------------------
| configure your wechat mini app info
|--------------------------------------------------------------------------
|         _ ____   ____ ________ ____  _____
|        / |_  _| |_  _|_   __  |_   \|_   _|
|       / _ \\ \   / /   | |_ \_| |   \ | |
|      / ___ \\ \ / /    |  _| _  | |\ \| |
|    _/ /   \ \\ ' /    _| |__/ |_| |_\   |_
|   |____| |____\_/    |________|_____|\____|
|
||           (c) aven.devlop@gamil.com
|
| This source file is subject to the MIT license that is bundled
| with this source code in the file LICENSE.
|
*/

return [
    'account' => [

        "appid" => "", //your AppId

        "secret" => "", //your AppSecret

        "code2session_url" => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    ]
];
