<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{

  public function __construct()
  {
    $this->middleware('auth:sanctum', ['except' => ['login', 'token', 'register', 'logout', 'social_login', 'forgot', 'forgotPasswordSubmit', 'resetPasswordSubmit', 'verifyEmailSubmit', 'verifyEmailResendCode']]);
  }


  public function login(Request $request)
  {
    try {
      $rules = [
        'email' => 'required',
        'password' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
      }

      $credentials = request(['email', 'password']);


      if (!auth()->attempt($credentials)) {
        return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "Email / password didn't match."]]);
      }

      $token = auth()->user()->createToken('authToken')->plainTextToken;
      if (auth()->user()->email_verified == 0) {
        $user = auth()->user();
        $gs = Generalsetting::first();
        $subject = 'Verify your email address.';
        $code = rand(100000, 999999);
        $user->verify_code = $code;
        $user->update();


        $msg = 'Dear ' . $request->username . ',<br> Please verify your email address. <br> Your verification code is </br>' . $code . '<br> <br> <br> Regards, <br> ' . $gs->title . ' Team';

        @email([
          'email'   => $request->email,
          'name'    => $request->username,
          'subject' => $subject,
          'message' => $msg,
        ]);

        auth()->logout();

        return response()->json(['status' => false, 'data' => ["email_verify" => false],"message" => 'Your Email is not Verified! Please verify your email address.']);
      }


      if (auth()->user()->is_banned == 1) {
        auth()->logout();
        return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Your Account Has Been Banned.']]);
      }

      return response()->json(['status' => true, 'data' => ['token' => $token, 'user' => auth()->user()], 'error' => []]);
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
    }
  }



  public function register(Request $request)
  {
    $gs = Generalsetting::first();
    try {
      $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        "confirm_password" => "required|same:password",
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
      }


      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $token = md5(time() . $request->name . $request->email);
      $user->verification_link = $token;
      // only number 
      $code = rand(100000, 999999);
      $user->verify_code = $code;
      $user->password = bcrypt($request->password);
      $user->save();

      if ($gs->is_verify == 0) {
        $user->email_verified = 1;
        $user->update();
        @email([
          'email'   => $request->email,
          'name'    => $request->username,
          'subject' => 'Welcome to ' . $gs->title,
          'message' => 'Dear Customer,<br> We noticed that you have registered on our website. <br> Thank you for registering with us. <br> Please login to your account and start bidding. <br> <br> <br> Regards, <br> ' . $gs->title . ' Team'
        ]);


        $token = auth()->login($user);
        return response()->json(['status' => true, 'data' => ['token' => $token, 'user' => $user], 'error' => []]);
      } else {


        $subject = 'Verify your email address.';

        $msg = 'Dear ' . $request->username . ',<br> Please verify your email address. <br> Your verification code is' . $code . '<br> <br> <br> Regards, <br> ' . $gs->title . ' Team';
        @email([
          'email'   => $request->email,
          'name'    => $request->username,
          'subject' => $subject,
          'message' => $msg,
        ]);

        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Please verify your email address.']]);
      }
    } catch (\Exception $e) {
      return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
    }
  }


  public function token(Request $request)
  {

    $gs = Generalsetting::findOrFail(1);
    if ($gs->is_verify == 1) {

      $user = User::where('verify_code', '=', $request->code)->first();

      if (isset($user)) {
        $user->email_verified = 1;
        $user->update();
        $token = auth()->login($user);
        return response()->json(['status' => true, 'data' => ['token' => $token, 'user' => new UserResource($user)], 'error' => ['message' => 'Your email is verified.']]);
      }
    } else {
      return response()->json(['status' => false, 'data' => [], 'error' => ['message' => 'Something went wrong.']]);
    }
  }

  public function logout()
  {
    auth()->user()->tokens()->delete();
    return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Logged out successfully']]);
  }


  public function forgotPasswordSubmit(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email'
    ]);
    if ($validator->fails()) {
      return $this->sendError('Validation Error', $validator->errors());
    }

    $exist = User::where('email', $request->email)->first();
    if (!$exist) {
      return $this->sendError('Sorry! Email doesn\'t exist');
    }

    $exist->verify_code = randNum();
    $exist->save();

    @email([
      'email'   => $exist->email,
      'name'    => $exist->name,
      'subject' => __('Password Reset Code'),
      'message' => __('Password reset code is : ') . $exist->verify_code,
    ]);

    $success['email'] = $exist->email;
    return $this->sendResponse($success, 'Reset code has been sent to email.');
  }


  public function resetPasswordSubmit(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'code' => 'required',
      'password' => 'required|confirmed|min:4'
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
    }
    $user = User::where('verify_code', $request->code)->first();
    if (!$user || !$request->code) {
      return $this->sendError('Invalid code', '403');
    }
    $user->password = bcrypt($request->password);
    $user->update();
    return $this->sendResponse([], 'Password reset successfully');
  }



  public function verifyEmailSubmit(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'code' => 'required|integer',
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors(), '403');
    }

    $user = User::where('email', $request->email)->where("verify_code", $request->code)->first();

    if (!$user) {
      return $this->sendError('User doesn\'t exist', '403');
    }

    if ($user->verify_code != $request->code) {
      return $this->sendError('Invalid verification code.',);
    }

    $user->verify_code = null;
    $user->email_verified = 1;
    $user->save();

    return $this->sendResponse([], 'Email has been verified');
  }

  public function verifyEmailResendCode(Request $request)
  {
    $user = User::where('email', $request->email)->first();
  
    if (!$user) {
      return $this->sendError('User doesn\'t exist');
    }

    $code = randNum();
    $user->verify_code = $code;
    $user->update();

    @email([
      'email'   => $user->email,
      'name'    => $user->name,
      'subject' => __('Email Verification Code'),
      'message' => __('Email Verification Code is : ') . $user->verify_code,
    ]);

    return $this->sendResponse([], 'Verify code resent to your email.');
  }
}
