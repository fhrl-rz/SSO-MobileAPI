<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function redirect()
    {
        // $queries = http_build_query([
        //     'client_id' => '',
        //     'redirect_uri' => '';
        //     'response_type' => '';

        // ]);  

        // return redirect('http://127.0.0.1:8000/oauth/authorize?' .$queries);
    }

    public function callback()
    {

    }
}