<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next)
    {
        if (isset($_COOKIE['token'])){
            try {
                $client = new Client();
                $res = $client->request('GET', BASE_URL_API."searchToken?token=".$request->cookie('token'));
                $user = json_decode($res->getBody()->getContents());
                if (isset($user->status) && $user->status == true && $user->data != null) {
                    if ($user->data->role == 1) {
                        if (strpos($request->route()->uri, 'dashboard/absensi') !== false) {
                            $request->user =  $user->data;
                            return $next($request);
                        }
                    } else if ($user->data->role == 2) {
                        if (strpos($request->route()->uri, 'dashboard/admin') !== false) {
                            $request->user =  $user->data;
                            return $next($request);
                        }
                    }
                }
            } catch (RequestException $e) {
//                echo Psr7\str($e->getRequest());
            }
        }
        return redirect('/');

    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
//    protected function redirectTo($request)
//    {
//        if (! $request->expectsJson()) {
//            return route('login');
//        }
//    }
}
