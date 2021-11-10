<?php

namespace App\Http\Controllers\Backend\Karyawan\Absensi;

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
            $res = $client->request('GET',BASE_URL_API."users/".$request->user->user_id."/attendance");
            $dataAbsensi = json_decode($res->getBody()->getContents());

        } catch (RequestException $e){
            abort(500);
        }
        return view('karyawan.dashboard.dashboard',['user' => $request->user,'dataAbsensi' => $dataAbsensi->data]);
    }

    public function absen(Request $request)
    {
        return view('karyawan.absensi.absensi',['user' => $request->user]);
    }

    public function izin(Request $request)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API . "users/".$request->user->user_id."/attendance/permission", [
                'form_params' => [
                    'permission' => $request->get('izin'),
                    'date' => $request->get('tgl')
                ]
            ]);
            $result = json_decode($res->getBody()->getContents());

            if ($result->status == true) {
                Session::flash(
                    'true',
                    "Berhasil izin"
                );
                return redirect()->route('dashboard.absensi.absen');
            }else{
                Session::flash(
                    'false',
                    $result->error
                );
                return Redirect::back();
            }
        } catch (RequestException $e) {
            abort(500);
        }

        Session::flash(
            'false',
            $result->error
        );
        return Redirect::back();
    }

    public function masuk(Request $request)
    {

        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API . "users/".$request->user->user_id."/attendance/in", [
                'form_params' => [
                    'status' => '1'
                ]
            ]);
            $result = json_decode($res->getBody()->getContents());

            if ($result->status == true) {
                Session::flash(
                    'true',
                    "Berhasil absen"
                );
                return redirect()->route('dashboard.absensi.absen');
            }else{
                Session::flash(
                    'false',
                    $result->error
                );
                return Redirect::back();
            }
        } catch (RequestException $e) {
            abort(500);
        }

        Session::flash(
            'false',
            $result->error
        );
        return Redirect::back();
    }

    public function keluar(Request $request)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', BASE_URL_API . "users/".$request->user->user_id."/attendance/out", [

            ]);
            $result = json_decode($res->getBody()->getContents());
            if ($result->status == true) {
                Session::flash(
                    'true',
                    "Berhasil absen"
                );
                return redirect()->route('dashboard.absensi.absen');
            }else{
                Session::flash(
                    'false',
                    $result->error
                );
                return Redirect::back();
            }
        } catch (RequestException $e) {
            abort(500);
        }
        Session::flash(
            'false',
            $result->error
        );
        return Redirect::back();
    }
}
