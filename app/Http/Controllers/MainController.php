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

    public function home() {
        return view('home');
    }

    public function about() {
        session();
        return view('about');
    }

    public function consultation(){
        #User view
        if(Auth::check() && Auth::user()->role == "user"){
            $cus = Consultation::where('user_id', Auth::id())->where('status', 'pending')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            
            $ccss = Consultation::where('user_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            
            $cogs = Consultation::where('user_id', Auth::id())->where('status', 'on going')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            
            $cufs = Consultation::where('user_id', Auth::id())->where('status', 'finished')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);

            $cucs = Consultation::where('user_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            return view('consultation', compact('cus', 'ccss', 'cogs', 'cufs', 'cucs'));
        } 
        #Consultant view 
        elseif(Auth::check() && Auth::user()->role == "consultant"){
            $ccus = Consultation::where('consultant_id', Auth::id())->where('status', 'pending')
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);

            $cccss = Consultation::where('consultant_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
            
            $ccogs = Consultation::where('consultant_id', Auth::id())->where('status', 'on going')
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);

            $ccfs = Consultation::where('consultant_id', Auth::id())->where('status', 'finished')
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);

            $cccs = Consultation::where('consultant_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
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
        $con = Consultation::findOrFail($request->id);
        $con->update([
                'title' => $request->title,
                'desc' => $request->desc,
                'user_id' => $request->user_id,
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
                ->get(['transactions.id', 'title', 'price', 'transaction_datetime', 'consultations.user_id']);

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
                ->get(['transactions.id', 'title', 'price', 'transaction_datetime', 'consultations.consultant_id']);

                $transCountC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->count('transactions.id');
            } else {
                $transC = "";
                $transCountC = 0;
            }
            return view('transactionhistory', compact('transC', 'transCountC'));
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

}
