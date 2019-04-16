<?php

namespace App\Http\Controllers\mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    //

    public function sendEmail(Request $request)
    {
        try {
            Mail::send('mail.email',
                [
                    'nama' => $request->nama,
                    'pesan' => $request->pesan
                ],
                function ($message) use ($request) {
                    $message->subject($request->judul);
                    $message->from('dev.cerdas.skd@gmail.com', 'Dev Cerdas');
                    $message->to($request->email);
                });
            return back()->with('alert-success', 'Berhasil Kirim Email');
        } catch (Exception $e) {
            return response(['status' => false, 'errors' => $e->getMessage()]);
        }
    }
}
