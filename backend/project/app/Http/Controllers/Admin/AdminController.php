<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Campaign;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Generalsetting;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['total_campaign'] = Campaign::count();
        $data['recent_campaigns'] = Campaign::orderby('id', 'desc')->take(5)->get();
        $data['recent_messages'] = ContactMessage::orderby('id', 'desc')->take(6)->get();
        $data['recent_donations'] = Donation::orderby('id', 'desc')->take(7)->get();
        $data['recent_users'] = User::orderby('id', 'desc')->take(6)->get();
        $data['total_subscribers'] = Subscriber::count();
        $data['total_projects'] = 1;
        $data['total_donations'] = Donation::count();
        $data['total_users'] = User::count();
        $data['total_events'] = Event::count();

        $data['donations'] = DB::table('donations')
            ->selectRaw('SUM(total) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as date')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get()
            ->toArray();

        $amount = [];
        $date = [];
        foreach ($data['donations'] as $key => $value) {
            $amount[] = round($value->total, 2);
            $date[] = $value->date;
        }

        $data['donation_amount'] = $amount;
        $data['donation_date'] = $date;

        $data['withdraws'] = DB::table('withdraws')
            ->selectRaw('SUM(total) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as date')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get()
            ->toArray();

        $amount = [];
        $date = [];
        foreach ($data['withdraws'] as $key => $value) {
            $amount[] = round($value->total, 2);
            $date[] = $value->date;
        }

        $data['withdraw_amount'] = $amount;
        $data['withdraw_date'] = $date;

        return view('admin.dashboard', $data);
    }

    // PROFILE
    public function profile()
    {
        $data = admin();
        return view('admin.profile', compact('data'));
    }

    // PROFILE
    public function profileupdate(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required|email', 'phone' => 'required']);
        $data = admin();
        $input = $request->only('name', 'photo', 'phone', 'email');

        if ($request->hasFile('photo')) {
            $status = MediaHelper::ExtensionValidation($request->file('photo'));
            if (!$status) {
                return back()->with('error', __('Image format is invalid'));
            }
            $input['photo'] = MediaHelper::handleUpdateImage($request->file('photo'), $data->photo, [200, 200]);
        }

        $data->update($input);
        return back()->with('success', __('Profile Updated Successfully'));
    }

    // CHANGE PASSWORD
    public function passwordreset()
    {
        return view('admin.change_password');
    }

    public function changepass(Request $request)
    {
        $request->validate(['old_password' => 'required', 'password' => 'required|confirmed|min:4']);
        $user = admin();
        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->update();
            } else {
                return back()->with('error', __('Old Password Mismatch'));
            }
        }

        return back()->with('success', __('Password Changed Successfully'));
    }

    public function subscribers()
    {
        $data['subscribers'] = Subscriber::orderBy('id', 'desc')->paginate(10);
        return view('admin.subscribers', $data);
    }

    public function subscribersDelete(Request $request)
    {
        $data = Subscriber::findOrFail($request->id);
        $data->delete();
        return back()->with('success', __('Subscriber Deleted Successfully'));
    }

    public function transactions()
    {
        $remark = request('remark');
        $search = request('search');

        $transactions = Transaction::when($remark, function ($q) use ($remark) {
            return $q->where('remark', $remark);
        })
            ->when($search, function ($q) use ($search) {
                return $q->where('trnx', $search);
            })
            ->latest()->paginate(15);
        return view('admin.transactions', compact('transactions', 'search'));
    }

    public function cookie()
    {
        return view('admin.cookie');
    }

    public function updateCookie(Request $request)
    {

        $data = $request->validate([
            'is_cookie' => 'required',
            'cookie_btn_text' => 'required',
            'cookie_text' => 'required',
        ]);

        $gs = Generalsetting::first();
        $gs->is_cookie = $data['is_cookie'];
        $gs->cookie_btn_text = $data['cookie_btn_text'];
        $gs->cookie_text = $data['cookie_text'];
        $gs->update();
        return back()->with('success', 'Cookie concent updated');
    }

    public function generate_bkup()
    {
        $bkuplink = "";
        $chk = file_get_contents('backup.txt');
        if ($chk != "") {
            $bkuplink = url($chk);
        }
        return view('admin.movetoserver', compact('bkuplink', 'chk'));
    }

    public function clear_bkup()
    {
        $destination = base_path('..') . '/install';
        $bkuplink = "";
        $chk = file_get_contents('backup.txt');
        if ($chk != "") {
            unlink(base_path($chk));
        }

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }
        $handle = fopen('backup.txt', 'w+');
        fwrite($handle, "");
        fclose($handle);
        //return "No Backup File Generated.";
        return redirect()->back()->with('success', 'Backup file Deleted Successfully!');
    }

    public function activation()
    {
        $activation_data = "";
        if (file_exists(base_path('..') . '/project/license.txt')) {
            $license = file_get_contents(base_path('..') . '/project/license.txt');
            if ($license != "") {
                $activation_data = "<i style='color:darkgreen;' class='icofont-check-circled icofont-4x'></i><br><h3 style='color:darkgreen;'>Your System is Activated!</h3><br> Your License Key:  <b>" . $license . "</b>";
            }
        }
        return view('admin.activation', compact('activation_data'));
    }

    public function activation_submit(Request $request)
    {

        $purchase_code = $request->pcode;
        $my_script = 'Charity';
        $my_domain = url('/');

        $varUrl = str_replace(' ', '%20', config('services.genius.ocean') . 'purchase112662activate.php?code=' . $purchase_code . '&domain=' . $my_domain . '&script=' . $my_script);

        if (ini_get('allow_url_fopen')) {
            $contents = file_get_contents($varUrl);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $varUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $contents = curl_exec($ch);
            curl_close($ch);
        }

        $chk = json_decode($contents, true);

        if ($chk['status'] != "success") {

            $msg = $chk['message'];
            return back()->with('error', $msg);
        } else {
            $this->setUp($chk['p2'], $chk['lData']);

            if (file_exists(base_path('..') . '/rooted.txt')) {
                unlink(base_path('..') . '/rooted.txt');
            }

            $fpbt = fopen(base_path('..') . '/project/license.txt', 'w');
            fwrite($fpbt, $purchase_code);
            fclose($fpbt);

            $msg = 'Congratulation!! Your System is successfully Activated.';
            return back()->with('success', $msg);
        }
    }




    public function setUp($mtFile, $goFileData)
    {
        $fpa = fopen(base_path('..') . $mtFile, 'w');
        fwrite($fpa, $goFileData);
        fclose($fpa);
    }

    public function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
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


    public function importAddon()
    {
        return view('admin.addon_import');
    }


    public function importAddonSubmit(Request $request)
    {
        $request->validate([
            'addon_charity' => 'required|mimes:zip|max:2048',
        ]);

        if ($request->file('addon_charity')->getClientOriginalName() != 'addon_charity.zip') {
            return back()->with('error', 'Invalid Addon File');
        }

        $gs = GeneralSetting::first();
        $checkAddon = $gs->is_addon;
        if ($checkAddon == 1) {
            return back()->with('error', 'You have already imported the addon');
        }
        $gs->is_addon = 1;
        $gs->save();

        return redirect()->back()->with('success', 'Addon imported successfully!');
    }
}
