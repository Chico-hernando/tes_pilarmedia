<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

}
