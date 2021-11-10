<?php

namespace App\Http\Controllers\Api\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{
    public function getAttendanceAll(Request $request)
    {
        if ($request->from == null && $request->to == null){
            $data = Attendance::join('users','users.id','=','attendance.user_id')
                ->join('attendance_detail','attendance_detail.id','=','attendance.status')
                ->select('users.name','attendance.*','attendance_detail.id AS status_id','attendance_detail.name AS status')->get();
        }else{
            $data = Attendance::whereBetween('attendance.created_at',[$request->from,$request->to])
                ->join('users','users.id','=','attendance.user_id')
                ->join('attendance_detail','attendance_detail.id','=','attendance.status')
                ->select('users.name','attendance.*','attendance_detail.id AS status_id','attendance_detail.name AS status')->get();
        }

        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }

    public function getAttendanceById(Request $request, $id)
    {
        if ($request->from == null && $request->to == null){
            $data = Attendance::where('user_id',$id)
                ->join('users','users.id','=','attendance.user_id')
                ->join('attendance_detail','attendance_detail.id','=','attendance.status')
                ->select('users.name','attendance.*','attendance_detail.id AS status_id','attendance_detail.name AS status')->get();
        }else{
            $data = Attendance::whereBetween('attendance.created_at',[$request->from,$request->to])
                ->join('users','users.id','=','attendance.user_id')
                ->join('attendance_detail','attendance_detail.id','=','attendance.status')
                ->select('users.name','attendance.*','attendance_detail.id AS status_id','attendance_detail.name AS status')
                ->where('user_id',$id)->get();
        }


        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }

    public function createPermission(Request $request, $id)
    {
        if ($request->permission == 'cuti'){
            $date=Date('Y-m-d', strtotime('+1 days'));
            $status = 4;

            if (date($request->date) < $date){
                return $this->responseError("Can't below 1 day", '');
            }

            $attendance = new Attendance();

            $attendance['status'] = $status;
            $attendance['created_at'] = now();
            $attendance['in'] = date($request->date);
            $attendance['out'] = date($request->date);
            $attendance['user_id'] = $id;

            if ($attendance->save()) {
                $data = Attendance::where('id', $attendance['id'])->get();
            } else {
                return $this->responseError('Failed create permission', 'Failed create permission');
            }

        } elseif ($request->permission == 'sakit'){
            $date=Date('Y-m-d', strtotime('-3 days'));
            $status = 7;

            if (date($request->date) < $date){
                return $this->responseError("Can't over 3 day", '');
            }

            $update = Attendance::where('user_id', $id)->whereDate('in','=',date($request->date))->update([
                'status' => $status,
                'in' => date($request->date),
                'out' => date($request->date),
                'updated_at' => now(),
            ]);
            if ($update){
                $data = Attendance::where('user_id', $id)->whereDate('in','=',date($request->date))->get();
            }else{
                return $this->responseError('Failed create permission', 'Failed create permission');
            }

        }else{
            return $this->responseError('Wrong permission', '');
        }

        return $this->responseSuccess('Success create permission', $data);
    }

    public function createAttendance($id)
    {
        $today = Attendance::where('user_id', $id)->whereDate('in', '=', date("Y-m-d"))->first();

        if (isset($today->in)){
            return $this->responseError('Already present', '');
        }
        $attendance = new Attendance();

        if (now() > $this->inTime()){
            $attendance['status'] = 3;
        } else{
            $attendance['status'] = 1;
        }

        $attendance['created_at'] = now();
        $attendance['in'] = now();
        $attendance['user_id'] = $id;

        if ($attendance->save()) {
            $data = Attendance::where('id', $attendance['id'])->get();
            return $this->responseSuccess('Success create data', $data);
        } else {
            return $this->responseError('Failed create data', 'Failed create data');
        }
    }

    public function outAttendance($id)
    {
        $today = Attendance::where('user_id', $id)->whereDate('in', '=', date("Y-m-d"))->first();

        if ($today == null) {
            return $this->responseError('Attendance in not found', 'please make attendance in first');
        }

        if ($today->out != null){
            return $this->responseError('Already out attendance', '');
        }

        if (now() < $this->outTime() || $today->status == 3) {
            $status = 3;
        } else {
            $status = 1;
        }

        $update = Attendance::where('id', $today->id)->update([
            'status' => $status,
            'out' => now()
        ]);
        if ($update) {
            $data = Attendance::where('id', $today->id)->get();
            return $this->responseSuccess('Success update Attendance', $data);
        } else {
            return $this->responseError('Failed update Attendance', 'Nothing to update');
        }
    }

    public function updateAttendance(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $update = Attendance::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        if ($update) {
            $data = Attendance::where('id', $request->id)->get();
            return $this->responseSuccess('Success update Attendance', $data);
        } else {
            return $this->responseError('Failed update Attendance', 'Nothing to update');
        }
    }
}
