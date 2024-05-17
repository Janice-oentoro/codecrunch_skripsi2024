<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Programming;
use App\Models\Topic;
use App\Models\ProgConsultant;
use App\Models\TopicConsultant;
use App\Models\Consultation;
use App\Models\ConsultationFeedback;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\User;
use Carbon\Carbon; #GET CURRENT TIME

class AdminController extends Controller
{
    public function dashboard() {
        $usersT = User::count('id');
        // $usersU = User::where('role', 'user')->count('id');
        // $usersC = User::where('role', 'consultant')->count('id');

        $consulsT = Consultation::count('id');
        // $consulsP = Consultation::where('status', 'pending')->count('id');
        // $consulsCS = Consultation::where('status', 'coming soon')->count('id');
        // $consulsOG = Consultation::where('status', 'on going')->count('id');
        // $consulsF = Consultation::where('status', 'finished')->count('id');
        // $consulsC = Consultation::where('status', 'cancelled')->count('id');

        $transT = Transaction::count('id');
        // $transO = Transaction::where('status', 'on going')->count('id');
        // $transS = Transaction::where('status', 'success')->count('id');
        // $transF = Transaction::where('status', 'failed')->count('id');

        $reqsP = Withdraw::where('status', 'pending')->count('id');
        // $reqsS = Withdraw::where('status', 'solved')->count('id');
        // $reqsPR = Withdraw::where('status', 'solved')->where('type', 'refund')->count('id');
        // $reqsPW = Withdraw::where('status', 'solved')->where('type', 'withdraw')->count('id');
        return view('admin-page.dashboard', compact('usersT', 'consulsT', 'transT', 'reqsP'));
    }

    public function userList() {
        $users = User::all();
        return view('admin-page.userlist', compact('users'));
    }

    public function requestList() {
        $reqs = Withdraw::all();
        return view('admin-page.requestlist', compact('reqs'));
    }

    public function suspendUser(Request $request) {
        User::where('id', $request->id)->update([
            'suspend' => true
        ]);
        return redirect()->route('userlist')->with('success', 'Suspend Success');
    }

    public function unsuspendUser(Request $request) {
        User::where('id', $request->id)->update([
            'suspend' => false
        ]);
        return redirect()->route('userlist')->with('success', 'Suspend Success');
    }

    public function acceptRequest(Request $request) {
        Withdraw::where('id', $request->id)->update([
            'status' => "success"
        ]);
        return redirect()->route('requestlist')->with('success', 'Accept Success');
    }

    public function rejectRequest(Request $request) {
        Withdraw::where('id', $request->id)->update([
            'status' => "failed"
        ]);
        return redirect()->route('requestlist')->with('success', 'Reject Success');
    }
}
