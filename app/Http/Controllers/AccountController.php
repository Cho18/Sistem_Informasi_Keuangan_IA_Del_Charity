<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Http\Requests\StoreaccountRequest;
use App\Http\Requests\UpdateaccountRequest;
use App\Http\Requests\VerifyOTPRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPVerification;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $users = User::all();
        return view('account.index', compact('users', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(account $account)
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateaccountRequest  $request
     * @param  \App\Models\account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateaccountRequest $request, account $account)
    {
        $user = Auth::user();

        $validatedData = $request->validated();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::delete('profile/' . $user->profile);
            }

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $originalFileName;
            $filePath = $file->storeAs('profile', $fileName);
            $user->profile = $filePath;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return redirect('/account')->with('success', 'Akun Anda berhasil diperbarui');
    }


    private function generateOTP()
    {
        // Generate a random 6-digit OTP code
        return mt_rand(100000, 999999);
    }

    public function verifyOtp(VerifyOTPRequest $request)
    {
        $otp = $request->input('otp');
        $storedOtp = Session::get('otp');

        if ($otp == $storedOtp) {
            // OTP verification successful, clear the OTP from the session
            Session::forget('otp');
            return redirect('/account')->with('success', 'OTP verification successful.');
        } else {
            return redirect('/account')->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
