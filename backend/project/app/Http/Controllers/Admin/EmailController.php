<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Generalsetting;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $templates = EmailTemplate::orderBy('id', 'desc')->paginate(15);
        return view('admin.email.index', compact('templates'));
    }

    public function config()
    {
        return view('admin.email.config');
    }

    public function edit($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.email.edit', compact('data'));
    }

    public function configUpdate(Request $request)
    {
        $this->validate($request, [
            'smtp_host' => 'required_if:mail_type,php_mailer',
            'smtp_port' => 'required_if:mail_type,php_mailer',
            'smtp_user' => 'required_if:mail_type,php_mailer',
            'smtp_pass' => 'required_if:mail_type,php_mailer',
            'mail_encryption' => 'required_if:mail_type,php_mailer',
            'from_email' => 'required',
            'from_name' => 'required',
        ]);

        $gs = Generalsetting::firstOrFail();
        $gs->mail_type = $request->mail_type;
        $gs->smtp_host = $request->smtp_host;
        $gs->smtp_port = $request->smtp_port;
        $gs->smtp_user = $request->smtp_user;
        $gs->smtp_pass = $request->smtp_pass;
        $gs->mail_encryption = $request->mail_encryption;
        $gs->from_email = $request->from_email;
        $gs->from_name = $request->from_name;
        $gs->save();

        Cache::forget('generalsettings');
        return back()->with('success', 'Email Configuration Updated Successfully!');
    }

    public function groupEmail()
    {
        $config = Generalsetting::findOrFail(1);
        return view('admin.email.group_mail', compact('config'));
    }

    public function groupemailpost(Request $request)
    {
        $users = User::whereStatus(1)->where('email_verified', 1)->get(['id', 'name', 'email']);
        foreach ($users as $user) {
            @email([
                'email' => $user->email,
                'name' => $user->name,
                'subject' => $request->subject,
                'message' => clean($request->message),
            ]);
        }
        return back()->with('success', 'Email sent to all users.');

    }

    public function update(Request $request, $id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $input['email_body'] = clean($input['email_body']);
        $data->update($input);
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

}
