<?php

namespace App\Models;

use CodeIgniter\Model;

class FrontendModel extends Model
{
    public function getToken()
    {
        $url = "http://localhost/pkl/index.php/auth/login";
        $loginInfo = array(
            'username' => 'user3',
            'password' => 'password'
        );

        $data = http_build_query($loginInfo);
        $context_options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type : application/x-www-from-urlencoded\r\n"
                    . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data
            )
        );

        $contex = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $contex);

        if ($result) {
            $json = json_decode($result);
            $token = $json->token;
            return $token;
        }
        return $result;

        //file_get_contents();
    }

    public function getData()
    {
        $token = $this->getToken();

        $url = "http://localhost/pkl/index.php/backend";

        $context_options = array(
            'http' => array(
                'method' => 'GET',
                'header' => "Authorization: Bearer" . $token
            )
        );
        $contex = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $contex);

        return $result;
    }
}
