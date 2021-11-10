<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getUser()
    {
        $data = User::join('role','role.id','=','users.role')
            ->select('users.*','role.name AS role')
            ->get();

        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $email = User::where('email',$request->email)->get();
        if (count($email) == 0) {
            return $this->responseError("Login failed", "Email not registered");
        }

        if (!Hash::check($request->password, $email[0]->password)) {
            return $this->responseError("Login failed", "Wrong password");
        }

        $token = bin2hex(random_bytes(100));
        $data = $email[0];
        $id = $data->id;
        $role = $data->role;

        DB::table('access_token')->insert(
            ['user_id' => $id,'role' => $role, 'token' => $token, 'created_at' => now()]
        );

        $data['token'] = $token;

        return $this->responseSuccess("Login successful", $data);
    }

    public function createUser(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $req = $request->all();
        $user = new User();

        foreach ($req as $key => $values) {
            $user[$key] = $values;

            if ($key == 'password') {
                $user[$key] = bcrypt($req['password']);
            }
        }

        if ($user->save()) {
            $data = User::where('id', $user['id'])->get();
            return $this->responseSuccess('Success create data', $data);
        } else {
            return $this->responseError('Failed create data', 'Failed create data');
        }
    }

    public function updateUser(Request $request,$id)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }


        $update = User::where('id', $id)->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if ($update) {
            $data = User::where('id', $id)->get();
            return $this->responseSuccess('Success update user', $data);
        } else {
            return $this->responseError('Failed update user', 'Nothing to update');
        }
    }

    public function deleteUser($id)
    {
        $delete = User::where('id', $id)->delete();
        if ($delete) {
            return $this->responseSuccess("Success delete user", "");
        } else {
            return $this->responseError("Failed delete user", "");
        }
    }

    public function getToken(Request $request)
    {
        $user = DB::table('access_token')->where('token', $request->query('token'))->get()[0];

//        if ($user->role == 1){
            $searchUser = (array) DB::table('access_token')
                ->join('users', 'users.id', '=', 'access_token.user_id')
                ->where('access_token.token', $request->query('token'))
                ->first();
//        } elseif ($user->role == 2){
//            $searchUser = (array) DB::table('access_token')
//                ->join('petugas', 'petugas.id', '=', 'access_token.userId')
//                ->where('access_token.token', $request->query('token'))
//                ->first();
//
//        }
        unset($searchUser["password"]);
        unset($searchUser["id"]);
        if (count($searchUser) > 0) {
            return $this->responseSuccess("Token is Valid!", $searchUser);
        } else {
            return $this->responseError("Token is Invalid!", "User not Found");
        }
    }

}
