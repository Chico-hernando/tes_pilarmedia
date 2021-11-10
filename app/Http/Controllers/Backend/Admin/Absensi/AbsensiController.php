<?php

namespace App\Http\Controllers\Backend\Admin\Absensi;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $client = new Client();
            $res = $client->request('GET',BASE_URL_API."attendance");
            $dataAbsensi = json_decode($res->getBody()->getContents());

        } catch (RequestException $e){
            abort(500);
        }
        return view('admin.absensi.table',['user' => $request->user,'dataAbsensi' => $dataAbsensi->data]);
    }

    public function approve(Request $request)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API . "attendance?_method=PUT", [
                'form_params' => [
                    'id' => $request->get("id"),
                    'status' => '5'
                ]
            ]);
            $result = json_decode($res->getBody()->getContents());
            if ($result->status == true) {
                Session::flash(
                    'true',
                    "Berhasil memberi izin"
                );
                return redirect()->route('dashboard.admin.absensi');
            }
        } catch (RequestException $e) {
            abort(500);
        }
        Session::flash(
            'false',
            "Gagal memberi izin"
        );
        return Redirect::back();
    }

    public function tolak(Request $request)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API . "attendance?_method=PUT", [
                'form_params' => [
                    'id' => $request->get("id"),
                    'status' => '6'
                ]
            ]);
            $result = json_decode($res->getBody()->getContents());
            if ($result->status == true) {
                Session::flash(
                    'true',
                    "Berhasil menolak"
                );
                return redirect()->route('dashboard.admin.absensi');
            }
        } catch (RequestException $e) {
            abort(500);
        }
        Session::flash(
            'false',
            "Gagal menolak"
        );
        return Redirect::back();
    }
}
