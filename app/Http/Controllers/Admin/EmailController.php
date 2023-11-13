<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    /**
     * get email blade
     */
    public function index()
    {
        $emails = EmailTemplate::all();
        return view('admin.emails.index', compact('emails'));
    }

    /**
     * get create blade email
     */
    public function edit($id)
    {
        $email = EmailTemplate::find($id);
        return view('admin.emails.edit', compact('email'));
    }

    /**
     * post edit email template
     */
    public function postEdit(Request $request)
    {
        $email = EmailTemplate::find($request->id);
        $email->subject = $request->subject;
        $email->body = $request->body;
        $email->save();
        Session::flash('success', "Edit emails successfully !");
        return redirect()->route('admin.emails');
    }
}
