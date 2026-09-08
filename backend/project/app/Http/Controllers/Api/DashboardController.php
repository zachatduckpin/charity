<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function dashboard()
    {

        $user = auth()->user();
        $data['total_campaign'] = $user->campaigns()->count();
        $data['total_donation'] = $user->donations()->count();
        $data['complete_campaign'] = $user->campaigns()->whereStatus(1)->count();
        $data['cancel_campaign'] = $user->campaigns()->whereStatus(2)->count();
        $data['total_fund'] = $user->campaigns()->sum('raised');
        $data['my_donations'] = $user->donations()->sum('total');
        $data['total_withdraw'] = $user->withdraws()->sum('total');
        $data['current_balance'] = $user->balance;
  
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function getDetails()
    {

        $user = auth()->user();
        $success['user'] = $user;
        $success['user']['photo'] = getPhoto($user->photo);
        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function profileSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|unique:users,email,' . auth()->id(),
            'name' => 'required',
            'phone' => 'required',
            'photo' => 'nullable|mimes:jpeg,jpg,png,PNG,JPG',
        ]);

        try {

            $user = auth()->user();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->zip = $request->zip;
            $user->address = $request->address;
            $user->country = $request->country;

            if ($request->photo) {
                $user->photo = MediaHelper::handleUpdateImage($request->photo, $user->photo, [300, 300]);
            }
            $user->update();

            return response()->json(['status' => true, 'data' => $user, 'success' => 'Profile updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => $user, 'error' => $th->getMessage()]);
        }
    }

    public function changePass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_pass' => 'required',
            'password' => 'required|confirmed|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        $user = auth()->user();

        if (Hash::check($request->old_pass, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->update();
            return response()->json(['status' => true, 'data' => [], 'message' => 'Password changed successfully']);
        }
        return response()->json(['status' => false, 'data' => [], 'error' => 'Old password does not match']);
    }

}
