<?php

namespace App\Controllers;

use App\Models\FrontendModel;

class Frontend extends BaseController
{
    public function testtoken()
    {
        $ws = new FrontendModel();

        print_r($ws->getToken());
    }
    public function index()
    {
        $pkl = new FrontendModel();

        $dataPkl = $pkl->getData();

        $data['dataPkl'] = json_decode($dataPkl);

        return view('home', $data);
    }

    public function tambahData()
    {
        return view('register');
    }
}
