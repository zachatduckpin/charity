<?php

use App\Models\Currency;
use App\Models\EmailTemplate;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function sysVersion()
{
    return '1.0';
}


function checkAddon()
{
    $gs = Generalsetting::first();
    if(@$gs->is_addon == 1)
    {
        return true;
    }
    return false;
}




function getPhoto($filename)
{
    if ($filename) {
        if (file_exists('assets/images' . '/' . $filename)) {
            return asset('assets/images/' . $filename);
        } else {
            return asset('assets/images/default.png');
        }

    } else {
        return asset('assets/images/default.png');
    }
}

function admin()
{
    return auth()->guard('admin')->user();
}

function theme()
{
    $gs = Generalsetting::findOrFail(1);
    return $gs->theme . '.';
}

function menu($route, $attr = 'active')
{
    if (is_array($route)) {
        foreach ($route as $value) {
            if (request()->routeIs($value)) {
                return $attr;
            }
        }
    } elseif (request()->routeIs($route)) {
        return $attr;
    }
}

function adminStore($price)
{
    $currency = Currency::whereDefault(1)->first();
    return $price / $currency->value;
}

function storePrice($price, $currency = null)
{
    if ($currency) {
        $currency = Currency::where('id', $currency)->first();
    } else {
        $currency = Currency::where('is_default', 1)->first();
    }
    return $price / $currency->value;
}

function showAdminAmount($amount)
{
    $currency = Currency::whereDefault(1)->first();
    return $currency->symbol . '' . round($amount * $currency->value, 2);
}

function showAdminWithoutCurrency($amount)
{
    $currency = Currency::whereDefault(1)->first();
    return round($amount * $currency->value, 2);
}

function tagFormat($tag)
{
    $common_rep = ["value", "{", "}", "[", "]", ":", "\""];
    $tag = str_replace($common_rep, '', $tag);
    if (!empty($tag)) {
        return $tag;
    } else {
        return null;
    }

}

function numFormat($amount, $length = 0)
{
    if (0 < $length) {
        return number_format($amount + 0, $length);
    }

    return $amount + 0;
}

function dateFormat($date, $format = 'd M Y -- h:i a')
{
    return Carbon::parse($date)->format($format);
}

function diffTime($date)
{
    return Carbon::parse($date)->diffForHumans();
}

function randNum($digits = 6)
{
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}

function str_rand($length = 12, $up = false)
{
    if ($up) {
        return Str::random($length);
    } else {
        return strtoupper(Str::random($length));
    }

}

function email($data)
{
    $gs = Generalsetting::first();

    if ($gs->mail_type == 'php_mail') {
        $headers = "From: $gs->sitename <$gs->email_from> \r\n";
        $headers .= "Reply-To: $gs->sitename <$gs->email_from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        @mail($data['email'], $data['subject'], $data['message'], $headers);
    } else {
        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->Host = $gs->smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $gs->smtp_user;
            $mail->Password = $gs->smtp_pass;

            if ($gs->mail_encryption == 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            $mail->Port = $gs->smtp_port;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($gs->from_email, $gs->from_name);
            $mail->addAddress($data['email'], $data['name']);
            $mail->addReplyTo($gs->from_email, $gs->from_name);
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body = $data['message'];
            $mail->send();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

function mailSend($key, array $data, $user)
{

    $gs = GeneralSetting::first();
    $template = EmailTemplate::where('email_type', $key)->first();

    if ($gs->email_notify) {
        $message = str_replace('{name}', $user->name, $template->email_body);

        foreach ($data as $key => $value) {
            $message = str_replace("{" . $key . "}", $value, $message);
        }

        if ($gs->mail_type == 'php_mail') {

            $headers = "From: $gs->sitename <$gs->email_from> \r\n";
            $headers .= "Reply-To: $gs->sitename <$gs->email_from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            @mail($user->email, $template->email_subject, $message, $headers);
        } else {
            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();
                $mail->Host = $gs->smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $gs->smtp_user;
                $mail->Password = $gs->smtp_pass;

                if ($gs->mail_encryption == 'ssl') {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                } else {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                }

                $mail->Port = $gs->smtp_port;
                $mail->CharSet = 'UTF-8';
                $mail->setFrom($gs->from_email, $gs->from_name);
                $mail->addAddress($user->email, $user->name);
                $mail->addReplyTo($gs->from_email, $gs->from_name);
                $mail->isHTML(true);
                $mail->Subject = $template->email_subject;
                $mail->Body = $message;
                $mail->send();
            } catch (Exception $e) {
                // throw new Exception($e);
            }
        }
    }

    if ($gs->sms_notify) {
        $message = str_replace('{name}', $user->name, $template->sms);
        foreach ($data as $key => $value) {
            $message = str_replace("{" . $key . "}", $value, $message);
        }
        sendSMS($user->phone, $message, $gs->contact_no);
    }
}

function filter($key, $value)
{
    $queries = request()->query();
    if (count($queries) > 0) {
        $delimeter = '&';
    } else {
        $delimeter = '?';
    }

    if (request()->has($key)) {
        $url = request()->getRequestUri();
        $pattern = "\?$key";
        $match = preg_match("/$pattern/", $url);
        if ($match != 0) {
            return preg_replace('~(\?|&)' . $key . '[^&]*~', "\?$key=$value", $url);
        }

        $filteredURL = preg_replace('~(\?|&)' . $key . '[^&]*~', '', $url);
        return $filteredURL . $delimeter . "$key=$value";
    }

    return request()->getRequestUri() . $delimeter . "$key=$value";
}

function setEnv($key, $value, $old = null)
{

    if ($old) {
        $keVal = $old;
    } else {
        $keVal = env($key);
    }

    file_put_contents(app()->environmentFilePath(), str_replace(
        $key . '=' . $keVal,
        $key . '=' . $value,
        file_get_contents(app()->environmentFilePath())
    ));
}

function adminpath()
{
    $location = asset('assets/images/');
    if (!file_exists($location)) {
        mkdir($location, 0777, true);
    }
    return $location;
}

function access($value)
{
    $sections = json_decode(Auth::guard('admin')->user()->role_data->section, true);
    if (!$sections) {
        return false;
    }
    if (in_array($value, $sections)) {
        return true;
    } else {
        return false;
    }
}

function apiCurrency($currency = null)
{
    if ($currency) {
        $currency = Currency::where('id', $currency)->first();
    } else {
        $currency = Currency::where('is_default', 1)->first();
    }
    return $currency;
}

function storeStorage($key, $value)
{
    file_put_contents(storage_path('ORD' . $key), json_encode($value));
}

function fronturl()
{
    $gs = Generalsetting::first();

    $url = $gs->frontend_url;
    // last character check remove / if exist
    if (substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
    }
    return $url;
}

function getStorage($key)
{
    return json_decode(file_get_contents(storage_path('ORD' . $key)));
}

function deleteStorage($key)
{
    if (file_exists(storage_path('ORD' . $key))) {
        unlink(storage_path('ORD' . $key));
    }
}

function transaction($amount, $txn_id, $user_id, $type, $remark = null, $check = null)
{
    $user = User::findOrFail($user_id);
    if ($type == "+") {
        $user->balance += $amount;
    } else {
        if ($check != "Donation") {
            $user->balance -= $amount;
        }
    }
    $user->save();

    $transaction = new Transaction();
    $transaction->user_id = $user_id;
    $transaction->amount = $amount;
    $transaction->txn_id = $txn_id;
    $transaction->type = $type;
    $transaction->remark = $remark;
    $transaction->created_at = Carbon::now();
    $transaction->save();
}
