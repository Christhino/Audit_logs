<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Staff;
use Carbon\Carbon;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use Auth;

class FormController extends Controller
{
    // view form
    public function index()
    {   
        if (Auth::check() && Auth::user()->role_name == 'Admin') {
            $data = DB::table('users')->get();
            return view('form.form',compact('data'));
        }
        else
        {
            return redirect()->route('home');
        }
        
    }
    
    //user activity logs 

    public function staffActivityLog() {
        $staffactivityLog = DB::table('staff_activity_logs')->get();
        return view('usermanagement.staff_activity_log', compact('staffactivityLog'));
    }

    // Employee detail 
    public function viewRecord()
    {
        $data = DB::table('staff')->get();
        return view('view_record.viewrecord',compact('data'));
    }

    // Employee detail
    public function viewDetail($id)
    {
        $data = DB::table('staff')->where('id',$id)->get();
        return view('view_record.viewdetail',compact('data'));

    }

    // view update
    public function viewUpdate(Request $request)
    {
        try{
            $id           = $request->id;
            $rec_id       = $request->rec_id;
            $fullName     = $request->fullName;
            $sex          = $request->sex;
            $emailAddress = $request->emailAddress;
            $phone_number = $request->phone_number;
            $position     = $request->position;
            $department   = $request->department;
            $salary       = $request->salary;
            
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $update = [

                'id'            => $id,
                'rec_id'        => $rec_id,
                'full_name'     => $fullName,
                'sex'           => $sex,
                'email_address' => $emailAddress,
                'phone_number'  => $phone_number,
                'position'      => $position,
                'department'    => $department,
                'salary'        => $salary,
            ];
            $loggedInUser = Auth::check() ? Auth::user() : null;

            $staffactivityLog = [
                'user_name' => $loggedInUser ? $loggedInUser->name : null, 
                'staff_name'    => $fullName,
                'sex'           => $sex,
                'email_address' => $emailAddress,
                'phone_number'  => $phone_number,
                'position'      => $position,
                'department'    => $department,
                'salary'        => $salary,
                'modify_user'  => 'Update',
                'date_time'    => $todayDate,
            ];
          
            DB::table('staff_activity_logs')->insert($staffactivityLog);
         
            Staff::where('id',$request->id)->update($update);
            Toastr::success('Data updated successfully :)','Success');
            return redirect()->route('form/view/detail');
        }catch(\Exception $e){

            Toastr::error('Data updated fail :)','Error');
            return redirect()->route('form/view/detail');
        }
    }

    // save 
    public function saveRecord(Request $request)
    {
        $request->validate([
            'fullName'     => 'required|string|max:255',
            'sex'          => 'required',
            'emailAddress' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric|min:9',
            'position'     => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'salary'       => 'required|string|max:255',
        ]);
        try{
            $fullName     = $request->fullName;
            $sex          = $request->sex;
            $emailAddress = $request->emailAddress;
            $phone_number = $request->phone_number;
            $position     = $request->position;
            $department   = $request->department;
            $salary       = $request->salary;

            $Staff = new Staff();
            $Staff->full_name     = $fullName;
            $Staff->sex           = $sex;
            $Staff->email_address = $emailAddress;
            $Staff->phone_number  = $phone_number;
            $Staff->position      = $position;
            $Staff->department    = $department;
            $Staff->salary        = $salary;
            $Staff->save();
            
            $loggedInUser = Auth::check() ? Auth::user() : null;
            
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();


            $staffactivityLog = [
                'user_name'     => $loggedInUser ? $loggedInUser->name : null,
                'staff_name'    => $request->fullName,
                'sex'           => $request->sex,
                'email_address' => $request->emailAddress,
                'phone_number'  => $request->phone_number,
                'position'      => $request->position,
                'department'    => $request->department,
                'salary'        => $request->salary,
                'modify_user'   => 'Create',
                'date_time'     => $todayDate,
            ];
            DB::table('staff_activity_logs')->insert($staffactivityLog);
            Toastr::success('Data added successfully :)','Success');
            return redirect()->route('form/view/detail');

        }catch(\Exception $e){

            Toastr::error('Data added fail :)','Error');
            return redirect()->back();
        }
    }

    // view delete
    public function viewDelete($id)
    {    
        $delete = Staff::find($id);
        $delete->delete();

        $loggedInUser = Auth::check() ? Auth::user() : null;
        
        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();


        $staffactivityLog = [
            'user_name'     => $loggedInUser ? $loggedInUser->name : null,
            'staff_name'    => $delete->full_name,
            'sex'           => $delete->sex,
            'email_address' => $delete->email_address,
            'phone_number'  => $delete->phone_number,
            'position'      => $delete->position,
            'department'    => $delete->department,
            'salary'        => $delete->salary,
            'modify_user'   => 'Delete',
            'date_time'     =>  $todayDate,
        ];

        DB::table('staff_activity_logs')->insert($staffactivityLog);

        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('form/view/detail');
    }
}
