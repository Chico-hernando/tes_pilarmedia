<?php

namespace App\Http\Controllers\Backend\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController
{

    public function login()
    {
        return view('home.login.index');
    }

    public function register()
    {
        return view('home.register.index');
    }

    public function loginAuth(Request $request)
    {
//        var_dump($request->password);
//        die();


        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API."login",
                [
                    'form_params' => [
                        'email' => $request->email,
                        'password' => $request->password
                    ]
                ]);

            $response = json_decode($res->getBody()->getContents());
            if ($response->status == true ) {
                if ($response->data->role == 1){
                    return redirect('dashboard/absensi')->withCookie(cookie()->forever('token', $response->data->token));
                } elseif ($response->data->role == 2){
                    return redirect('dashboard/admin')->withCookie(cookie()->forever('token', $response->data->token));
                }
            } else {
                $messsageError = $response->message;
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $messsageError = $e->getResponse();
            }
        }
        Session::flash(
            'false', $messsageError
        );
        return Redirect::back();
    }

    public function logout()
    {
        $cookie = Cookie::forget('token');
        return Redirect::to('/')->withCookie($cookie);
    }
}
