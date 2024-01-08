<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\MailConfig;
use App\Mail\PermissionsPortDeniedMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendMail($email, $login, $password)
    {
        try {
            dispatch(Mail::to($email)->send(new MailConfig($login, $password)));
            return response()->json(['message' => 'Email is being sent in the background.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function sendPermissionsPortDeniedMail($email , $motifRefus)
    {
        try {
            dispatch(Mail::to($email)->send(new PermissionsPortDeniedMail($motifRefus)));
            return response()->json(['message' => 'Email is being sent in the background.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function sendEmailWithFileAttachment($email, $file){
        $data["email"] = $email;
        $data["body"] = "Mail For Finac Team";

        $files = [
            $file,
        ];

        Mail::send('email.pdfemail', $data, function($message) use ($data, $files) {
            $message->to($data["email"])
                ->subject($data["body"]);

            foreach ($files as $file){
                $message->attach($file);
            }
        });
    }


}
