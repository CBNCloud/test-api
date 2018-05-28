## Introduction
This sample demonstrates Rest Api Lumen Laravel.


[![Build Status](https://travis-ci.org/CBNCloud/test-api.svg?branch=master)](https://travis-ci.org/CBNCloud/test-api)

## Table of contents

<!--ts-->
   * [Install](#install)
   * [Environmnet](#environmnet)
   * [Generate keys](#generate-keys)
   * [Login ](#login)
   * [Middleware Application](#middleware-application)
<!--te-->

## Install

```bash
# Clone Your Computer / Server
 git clone git@github.com:CBNCloud/test-api.git
 
# use folder test-api
 cd test-api
 
# update composer 
 composer update

```

## environmnet
```
# setup database, if you use database
cp .env.example .env

# open file .env
nano .env 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## generate keys
```bash
# generate keys or APP_KEY
 php artisan key:generate
```

## login
if you use lumen service api, you must have token api, if you don't token api you cannot not to access application, let's start

1. get access token 
```
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api-lumen.local/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"member_username\"\r\n\r\ncontoso\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"member_password\"\r\n\r\ncontoso\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 10b5f6ce-50a9-d663-1adf-5450893c2bde"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

# response 
{
    "success": true,
    "api_token": "ac0d7c76c954745b064095847901c08a11a5b61e",
    "message": {
        "memberid": 32,
        "member_username": "contoso",
        "member_email": "contoso@yahoo.com",
        "member_fullname": "contoso",
        "member_images": "",
        "lastlogin": "2018-05-24 06:38:58"
    }
}

```

## middleware application 
```
# middleware application 

public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->header('api-token')) {
                $token       = $request->input('api-token');
                $check_token = $this->model->where('api_token', $token)->first();
                if ($check_token == null) {
                    $res['success'] = false;
                    $res['message'] = 'Permission not allowed!';
                
                    return response($res);
                }
            } else {
                $res['success'] = false;
                $res['message'] = 'Login please!';
            
                return response($res);
            }
        }
    
        return $next($request);
    }
```
