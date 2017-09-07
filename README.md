# wemini_sdk


```
          _ ____   ____ ________ ____  _____
         / |_  _| |_  _|_   __  |_   \|_   _|
        / _ \\ \   / /   | |_ \_| |   \ | |
       / ___ \\ \ / /    |  _| _  | |\ \| |
     _/ /   \ \\ ' /    _| |__/ |_| |_\   |_
    |____| |____\_/    |________|_____|\____|

```


## install

    composer require aven/wemin


##  example

* get openid and session_key

```php

      $wechat = new \Aven\WeMini\WeMini("appId", "appSecret");
      $wechat->getLoginInfo($code);
      
```

* get userInfo by cipher

```php

    $wechat->getUserInfo("encryptedData","iv");
   
```
