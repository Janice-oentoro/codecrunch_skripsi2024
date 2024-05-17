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

class MainController extends Controller
{
    public function loginPage() {
        session();
        return view('login');
    }
    
    public function registerPage() {
        session();
        return view('register');
    }

    public function land(Request $request) {
        session();
        $search = $request['search'] ?? "";
        $filterprog = $request['filterprog'] ?? "";
        $filtertopic = $request['filtertopic'] ?? "";

        if($search != "") {
            $users = User::where('role', 'consultant')->where('name', 'LIKE', "%$search%")
            ->where('suspend', false)->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")->where('suspend', false)->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } else {
            $users = User::where('role', 'consultant')->where('suspend', false)
            ->get(['users.id', 'name', 'price','avatar']);
        }
        return view('land', compact('users', 'search', 'filterprog'));
    }

    public function detailConsultant(Request $request){
        $udtl = User::findOrFail($request->id);

        if(ConsultationFeedback::where('consultant_id', $udtl->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
        ->exists()) {
            $avgRating = ConsultationFeedback::where('consultant_id', $udtl->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
            ->avg('rating');            
            
            $countRating = ConsultationFeedback::where('consultant_id', $udtl->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
            ->count('rating');
        } else {
            $avgRating = 0;
            $countRating = 0;
        }

        return view('detailconsultant', compact('udtl', 'avgRating', 'countRating'));
    }

    public function about() {
        session();
        return view('about');
    }

    public function consultation(){
        #User view
        if(Auth::check() && Auth::user()->role == "user"){
            if($cus = Consultation::where('user_id', Auth::id())->where('status', 'pending')
            ->join('users', 'consultant_id', '=', 'users.id')->exists()){
                $cus = Consultation::where('user_id', Auth::id())->where('status', 'pending')
                ->join('users', 'consultant_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);    
            } else {
                $cus = "";
            }
            
            if(Consultation::where('user_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'consultant_id', '=', 'users.id')->exists()){
                $ccss = $ccss = Consultation::where('user_id', Auth::id())->where('status', 'coming soon')
                ->join('users', 'consultant_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            } else {
                $ccss = "";
            }

            if(Consultation::where('user_id', Auth::id())->where('status', 'on going')
            ->join('users', 'consultant_id', '=', 'users.id')->exists()){
                $cogs = Consultation::where('user_id', Auth::id())->where('status', 'on going')
                ->join('users', 'consultant_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            } else {
                $cogs = "";
            }

            
            if(Consultation::where('user_id', Auth::id())->where('status', 'finished')
            ->join('users', 'consultant_id', '=', 'users.id')->exists()) {
                $cufs = Consultation::where('user_id', Auth::id())->where('status', 'finished')
                ->join('users', 'consultant_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            } else {
                $cufs ="";
            }
            
            if(Consultation::where('user_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'consultant_id', '=', 'users.id')->exists()){
                $cucs = Consultation::where('user_id', Auth::id())->where('status', 'cancelled')
                ->join('users', 'consultant_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            } else {
                $cucs = "";
            }
            return view('consultation', compact('cus', 'ccss', 'cogs', 'cufs', 'cucs'));
        } 
        #Consultant view 
        elseif(Auth::check() && Auth::user()->role == "consultant"){
            if(Consultation::where('consultant_id', Auth::id())->where('status', 'pending')
            ->join('users', 'user_id', '=', 'users.id')->exists()){
                $ccus = Consultation::where('consultant_id', Auth::id())->where('status', 'pending')
                ->join('users', 'user_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);        
            } else {
                $ccus = "";
            }

            if(Consultation::where('consultant_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'user_id', '=', 'users.id')->exists()){
                $cccss = Consultation::where('consultant_id', Auth::id())->where('status', 'coming soon')
                ->join('users', 'user_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            } else {
                $cccss = "";
            }

            if(Consultation::where('consultant_id', Auth::id())->where('status', 'on going')
            ->join('users', 'user_id', '=', 'users.id')->exists()){
                $ccogs = Consultation::where('consultant_id', Auth::id())->where('status', 'on going')
                ->join('users', 'user_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);        
            } else {
                $ccogs = "";
            }

            if(Consultation::where('consultant_id', Auth::id())->where('status', 'finished')
            ->join('users', 'user_id', '=', 'users.id')->exists()){
                $ccfs = Consultation::where('consultant_id', Auth::id())->where('status', 'finished')
                ->join('users', 'user_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);        
            } else {
                $ccfs = "";
            }

            if($cccs = Consultation::where('consultant_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'user_id', '=', 'users.id')->exists()){
                $cccs = Consultation::where('consultant_id', Auth::id())->where('status', 'cancelled')
                ->join('users', 'user_id', '=', 'users.id')
                ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);        
            } else {
                $cccs = "";
            }
            
            return view('consultation', compact('ccus', 'cccss', 'ccogs', 'ccfs', 'cccs'));
        }
       else{
        return redirect()->route('login')->with('success', "Login First");
       } 
    }

    public function addConsultation(){
        return view('addconsultation');
    }

    public function editProfile()
    {
        if(Auth::check() && Auth::user()->role == "user" || Auth::check() && Auth::user()->role == "consultant"){
            return view('editprofile');
        }
       else{
        return redirect()->route('login')->with('success', "Login First as Consultant");
       } 
    }

    public function viewSkill()
    {
        if(Auth::check() && Auth::user()->role == "consultant"){
            $programmings = Programming::all();
            $topics = Topic::all();
            $progcons = ProgConsultant::where('consultant_id', Auth::id())
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->get(['prog_consultants.id', 'consultant_id', 'prog_name']);
            $topiccons = TopicConsultant::where('consultant_id', Auth::id())
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->get((['topic_consultants.id', 'consultant_id', 'topic_name']));
            return view('editskill', compact('programmings', 'topics', 'progcons', 'topiccons'));
        }
       else{
        return redirect()->route('login')->with('success', "Login First as Consultant");
       } 
    }

    public function addConProg(Request $request){
        $pc = new ProgConsultant();
        $pc->prog_id = $request->prog_id;
        $pc->consultant_id = $request->consultant_id; 
        $pc->save();
        return redirect()->back()->with('success',"Add Programming Skill Success");
    }

    public function addConTopic(Request $request){
        $tc = new TopicConsultant();
        $tc->topic_id = $request->topic_id;
        $tc->consultant_id = $request->consultant_id;
        $tc->save();
        return redirect()->back()->with('success',"Add Topic Skill Success");
    }

    public function deleteConProg(Request $request)
    {
        ProgConsultant::where('id', $request->progcon_id)->delete();
        return redirect()->back()->with('success',"Delete Success");
    }

    public function deleteConTopic(Request $request)
    {
        TopicConsultant::where('id', $request->topic_id)->delete();
        return redirect('/editskill')->with('success',"Delete Success");
    }

    public function addCon(Request $request){
        $user_id = User::where('name', $request->name)->select('id')->first();

        $c = new Consultation();
        $c->user_id = $user_id->id;
        $c->consultant_id = $request->consultant_id; 
        $c->title = $request->title;
        $c->desc = $request->desc;
        $c->type = $request->type;
        $c->consult_datetime = $request->consult_datetime;
        $c->end_consult_datetime = $request->end_consult_datetime;
        $c->status = $request->status;
        $c->link = $request->link;
        $c->save();
        return redirect('/consultation')->with('success',"Add Programming Skill Success");
    }

    public function cancelCon(Request $request)
    {
        Consultation::where('id', $request->consultation_id)->update([
            'status' => 'cancelled'
        ]);
        return redirect()->back()->with('success',"Cancel Consultation Success");
    }

    public function editCon(Request $request)
    {
        $user_id = User::where('name', $request->name)->select('id')->first();

        $con = Consultation::findOrFail($request->id);
        $con->update([
                'title' => $request->title,
                'desc' => $request->desc,
                'user_id' => $user_id,
                'type' => $request->type,
                'consult_datetime' => $request->consult_datetime,
                'end_consult_datetime' => $request->endconsult_datetime,
                'link' => $request->link
            ]);
            return redirect()->back()->with('success', 'Edit Consultation Success');
    }

    public function addFeedback(Request $request)
    {
        $cf = new ConsultationFeedback();
        $cf->consultation_id = $request->consultation_id;
        $cf->rating = $request->rating; 
        $cf->comment = $request->comment;
        $cf->save();
        return redirect('/consultation')->with('success',"Add Feedback Success");
    }

    public function viewTransactionHistory(){
        if(Auth::check() && Auth::user()->role == "user") {
            // User View
            if(Transaction::where('transactions.user_id', Auth::id())->join('consultations', 'transactions.consultation_id', 'consultations.id')
            ->exists()){
                $transU = Transaction::where('consultations.user_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->get(['transactions.id', 'title', 'amount', 'transaction_datetime', 'consultations.user_id']);

                $transCountU = Transaction::where('consultations.user_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->count('transactions.id');
            } else {
                $transU="";
                $transCountU = 0;
            }
            return view('transactionhistory', compact('transU', 'transCountU'));
        } elseif(Auth::check() && Auth::user()->role == "consultant") {
            // Consultant View
            if(Transaction::where('consultations.consultant_id', Auth::id())->join('consultations', 'transactions.consultation_id', 'consultations.id')
            ->exists()){
                $transC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->get(['transactions.id', 'title', 'amount', 'transaction_datetime', 'consultations.consultant_id']);

                $transCountC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->count('transactions.id');

                $transSumC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->sum('amount');

                if(Withdraw::where('user_id', Auth::id())->where('status', 'success')->exists()){
                    $transWithdraw = Withdraw::where('user_id', Auth::id())->where('status', 'success')
                    ->where('type', 'withdraw')->sum('amount');
                } else {
                    $transWithdraw = 0;
                }
                
                if($transRefund = Withdraw::where('consultations.consultant_id', Auth::id())
                ->join('transactions', 'transaction_id', 'transactions.id')
                ->join('consultations', 'consultation_id', 'consultations.id')
                ->where('withdraws.status', 'success')
                ->where('withdraws.type', 'refund')->exists()) {
                    $transRefund = Withdraw::where('consultations.consultant_id', Auth::id())
                    ->join('transactions', 'transaction_id', 'transactions.id')
                    ->join('consultations', 'consultation_id', 'consultations.id')
                    ->where('withdraws.status', 'success')
                    ->where('withdraws.type', 'refund')->sum('withdraws.amount');
                } else {
                    $transRefund = 0;
                }
                
                $transWallet = $transSumC - $transWithdraw - $transRefund;
            } else {
                $transC = "";
                $transCountC = 0;
                $transWallet = 0;
            }
            return view('transactionhistory', compact('transC', 'transCountC', 'transWallet'));
        } else {
            return redirect()->route('login')->with('success', "Login First");
        }
    }

    public function viewFeedback(){
        if(Auth::check() && Auth::user()->role == "consultant"){
            if(ConsultationFeedback::where('consultant_id', Auth::id())->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
            ->exists()) {
                $feedbacks = ConsultationFeedback::where('consultant_id', Auth::id())->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->get(['rating', 'comment', 'user_id', 'title']);

                $avgRating = ConsultationFeedback::where('consultant_id', Auth::id())->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->avg('rating');            
                
                $countRating = ConsultationFeedback::where('consultant_id', Auth::id())->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->count('rating');
            } else {
                $feedbacks = "none";
                $avgRating = 0;
                $countRating = 0;
                return view('feedback', compact('feedbacks', 'avgRating', 'countRating'));
            }
            return view('feedback', compact('feedbacks', 'avgRating', 'countRating'));
        }else{
            return redirect()->route('login')->with('success', "Login First");
        }
    }

    public function addRefund(Request $request){
        $rf = new Withdraw();
        $rf->transaction_id = $request->transaction_id;
        $rf->user_id = $request->user_id;
        $rf->bank_acc = $request->bank_acc; 
        $rf->amount = $request->amount;
        $rf->type = $request->type;
        $rf->status = $request->status;
        $rf->save();
        return redirect('/transactionhistory')->with('success',"Add Refund Success");
    }

    public function addWithdraw(Request $request){
        $wt = new Withdraw();
        $wt->user_id = $request->user_id;
        $wt->bank_acc = $request->bank_acc; 
        $wt->amount = $request->amount;
        $wt->type = $request->type;
        $wt->status = $request->status;
        $wt->save();
        return redirect('/transactionhistory')->with('success',"Add Withdraw Success");
    }

}
