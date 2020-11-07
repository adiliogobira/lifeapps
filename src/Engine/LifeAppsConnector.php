<?php

namespace Lifeapps\Integration\Engine;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

abstract class LifeAppsConnector
{
    protected $endpoint;
    protected $headers;
    protected $params;
    protected $callback;
    protected $dispach;
    protected $token;
    public const LIFEAPPS_API_URL = env('LIFE_APPS_URL');
    public const LIFEAPPS_TOKEN_FORNECEDOR = env('LIFE_APPS_FORNECEDOR');
    public const LIFEAPPS_TOKEN_SPLIT = env('LIFE_APPS_TOKEN_SPLIT');
    public const LIFEAPPS_SEGMENT = "ccc4ce04-2c6a-4364-b42a-898ad83d1878";

    public function __construct()
    {
        $vendor = self::LIFEAPPS_TOKEN_FORNECEDOR;
        $this->header = [
            'Content-Type: application/json',
            "X-idfornecedor: ['{$vendor}']"
        ];

        if (!Session::has('token')) {
            Session::put(['token' => Str::uuid()]);
            Session::save();
        }

        $this->token = Session::get('token');
    }

    protected function post()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => self::LIFEAPPS_API_URL . $this->endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($this->params),
            CURLOPT_HTTPHEADER => $this->headers,
        ]);
        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }

    protected function get()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => self::LIFEAPPS_API_URL . $this->endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $this->headers,
        ]);
        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }

    protected function getWin($endpoint)
    {
        set_time_limit(0);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);
        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }
}
