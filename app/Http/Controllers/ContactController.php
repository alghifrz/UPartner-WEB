<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Di Controller
    public function send(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ]);

            // Kirim email
            Mail::send('emails.contact', [
                'name' => $request->name,
                'email' => $request->email,
                'content' => $request->message
            ], function($mail) use($request) {
                $mail->from($request->email, $request->name);
                $mail->to('upartner2024@gmail.com')->subject("Pesan Baru dari {$request->name}");
            });

            return redirect()->back()->with('success', 'Email berhasil dikirim!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}

?>
