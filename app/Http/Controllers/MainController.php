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
use App\Rules\nameMatch;
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

    public function getTopics($progName)
    {
        // Fetch topics where the topic name contains the programming name
        $topics = Topic::where('topic_name', 'like', '%' . $progName . '%')->get();

        return response()->json($topics);
    }

    public function land(Request $request) {
        session();
        $search = $request['search'] ?? "";
        $filterprog = $request['filterprog'] ?? "";
        $filtertopic = $request['filtertopic'] ?? "";

        if($search != "") {
            $users = User::where('role', 'consultant')->where('name', 'LIKE', "%$search%")
            ->where('suspend', false)->select('users.id', 'name', 'price', 'avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($search != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($search != "" && $filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($search != "" && $filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } elseif($filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")->where('suspend', false)->distinct()
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        } else {
            $users = User::where('role', 'consultant')->where('suspend', false)
            ->select('users.id', 'name', 'price','avatar')
            ->inRandomOrder()->paginate(6);
        }
        return view('land', compact('users', 'search', 'filterprog', 'filtertopic'));
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
        if(Consultation::where('user_id', Auth::id())->where('status', 'pending')
        ->join('users', 'consultant_id', '=', 'users.id')->exists()){
            $ps= Consultation::where('user_id', Auth::id())->where('status', 'pending')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $ps = "";
        }
        
        if(Consultation::where('user_id', Auth::id())->where('status', 'coming soon')
        ->join('users', 'consultant_id', '=', 'users.id')->exists()){
            $cms = $ccss = Consultation::where('user_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $cms = "";
        }

        if(Consultation::where('user_id', Auth::id())->where('status', 'on going')
        ->join('users', 'consultant_id', '=', 'users.id')->exists()){
            $ogs = Consultation::where('user_id', Auth::id())->where('status', 'on going')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $ogs = "";
        }
        
        if(Consultation::where('user_id', Auth::id())->where('status', 'finished')
        ->join('users', 'consultant_id', '=', 'users.id')->exists()) {
            $fs = Consultation::where('user_id', Auth::id())->where('status', 'finished')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $fs ="";
        }
        
        if(Consultation::where('user_id', Auth::id())->where('status', 'cancelled')
        ->join('users', 'consultant_id', '=', 'users.id')->exists()){
            $cs = Consultation::where('user_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'consultant_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $cs = "";
        }
        return view('consultation', compact('ps', 'cms', 'ogs', 'fs', 'cs'));
    } 
    #Consultant view 
    elseif(Auth::check() && Auth::user()->role == "consultant"){
        if(Consultation::where('consultant_id', Auth::id())->where('status', 'pending')->exists()){
            $ps = Consultation::where('consultant_id', Auth::id())->where('status', 'pending')
            ->join('users', 'user_id', '=', 'users.id')         
            ->orderByDesc('consultations.created_at')   
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);    
        } else {
            $ps = "";
        }

        if(Consultation::where('consultant_id', Auth::id())->where('status', 'coming soon')
        ->join('users', 'user_id', '=', 'users.id')->exists()){
            $cms = Consultation::where('consultant_id', Auth::id())->where('status', 'coming soon')
            ->join('users', 'user_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $cms = "";
        }

        if(Consultation::where('consultant_id', Auth::id())->where('status', 'on going')
        ->join('users', 'user_id', '=', 'users.id')->exists()){
            $ogs = Consultation::where('consultant_id', Auth::id())->where('status', 'on going')
            ->join('users', 'user_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $ogs = "";
        }

        if(Consultation::where('consultant_id', Auth::id())->where('status', 'finished')
        ->join('users', 'user_id', '=', 'users.id')->exists()){
            $fs = Consultation::where('consultant_id', Auth::id())->where('status', 'finished')
            ->join('users', 'user_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $fs = "";
        }

        if(Consultation::where('consultant_id', Auth::id())->where('status', 'cancelled')
        ->join('users', 'user_id', '=', 'users.id')->exists()){
            $cs = Consultation::where('consultant_id', Auth::id())->where('status', 'cancelled')
            ->join('users', 'user_id', '=', 'users.id')
            ->orderByDesc('consultations.created_at')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 
            'consultations.id', 'consult_datetime', 'end_consult_datetime', 'avatar']);
        } else {
            $cs = "";
        }
        return view('consultation', compact('ps', 'cms', 'ogs', 'fs', 'cs'));
    } else {
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
            $programmings = Programming::orderBy('prog_name', 'ASC')->get();; 
            $topics = Topic::orderBy('topic_name', 'ASC')->get();;
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
        return redirect()->back()->with('success-del',"Delete Programming Success");
    }

    public function deleteConTopic(Request $request)
    {
        TopicConsultant::where('id', $request->topic_id)->delete();
        return redirect('/editskill')->with('success-del',"Delete Topic Success");
    }

    public function addCon(Request $request){
        $rules = [
            'title' => 'required|string|min:5|max:20',
            'desc' => 'required|string|min:10|max:50',
            'name' => ['required', 'string', new nameMatch],
            'consult_datetime' => 'required|after_or_equal:now',
            'end_consult_datetime' => 'required|after_or_equal:consult_datetime'
        ];
        $msg = [
            'title.string' => 'Title must be string',
            'title.min' => 'Title must be filled with min 5 characters',
            'title.max' => 'Title must below than 20 characters',
            'title.required' => 'Title is required',
            'desc.required' => 'Description is required',
            'desc.string' => 'Description must be string',
            'desc.min' => 'Description must be filled with min 10 characters',
            'desc.max' => 'Description must below than 50 characters',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be in string',
            'name.nameMatch' => 'Name must be an exact match',
            'consult_datetime.required' => 'Start Datetime needed',
            'consult_datetime.after_or_equal:now' => 'Start Datetime must be atleast from now',
            'end_consult_datetime.required' => 'End Datetime needed',
            'end_consult_datetime.after_or_equal:consult_datetime' => 'End Datetime must be atleast from Start Datetime',
        ];

       $request->validate($rules,$msg);
       
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
        return redirect('/consultation')->with('success',"Add Consultation Success");
    }

    public function cancelCon(Request $request)
    {
        Consultation::where('id', $request->consultation_id)->update([
            'status' => 'cancelled'
        ]);
        return redirect()->back()->with('success-del',"Cancel Consultation Success");
    }

    public function editCon(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:5|max:20',
            'desc' => 'required|string|min:10|max:50',
            'name' => 'required|string',
            'consult_datetime' => 'required|after_or_equal:now',
            'end_consult_datetime' => 'required|after_or_equal:now'
        ];
        $msg = [
            'title.string' => 'Title must be string',
            'title.min' => 'Title must be filled with min 5 characters',
            'title.max' => 'Title must below than 50 characters',
            'title.required' => 'Title is required',
            'desc.required' => 'Description is required',
            'desc.string' => 'Description must be string',
            'desc.min' => 'Description must be filled with min 10 characters',
            'desc.max' => 'Description must below than 255 characters',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be in string',
            'consult_datetime.required' => 'Start Datetime needed',
            'consult_datetime.after_or_equal:now' => 'Start Datetime must be atleast from now',
            'end_consult_datetime.required' => 'End Datetime needed',
            'end_consult_datetime.after_or_equal:consult_datetime' => 'End Datetime must be atleast from Start Datetime',
        ];

       $request->validate($rules, $msg);
        $user_id = User::where('name', $request->name)->select('id')->first();

        Consultation::where('consultations.id', $request->id)->update([
                'title' => $request->title,
                'desc' => $request->desc,
                'user_id' => $user_id->id,
                'type' => $request->type,
                'consult_datetime' => $request->consult_datetime,
                'end_consult_datetime' => $request->end_consult_datetime,
                'link' => $request->link
            ]);
        return redirect('/consultation')->with('success-edit', 'Edit Consultation Success');
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
                $transU = Transaction::where('transactions.user_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->latest('transactions.created_at')
                ->select('transactions.id', 'title', 'amount', 'transaction_datetime', 'transactions.user_id')
                ->paginate(3, ['*'], 'transU');

                $transCountU = Transaction::where('transactions.user_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->count('transactions.id');
            } else {
                $transU="";
                $transCountU = 0;
            }

            if(Withdraw::where('withdraws.user_id', Auth::id())->where('withdraws.type', 'refund')
            ->exists()){
                $transUR = Withdraw::where('withdraws.user_id', Auth::id())
                ->where('withdraws.type', 'refund')
                ->latest('withdraws.created_at')
                ->select('withdraws.id', 'transaction_id','withdraws.type', 'amount', 
                'withdraws.created_at AS ref_datetime', 'withdraws.user_id', 'status')
                ->paginate(3, ['*'], 'transUR');

                $transURC = Withdraw::where('withdraws.user_id', Auth::id())
                ->where('withdraws.type', 'refund')
                ->count('withdraws.id');
            } else {
                $transUR="";
                $transURC = 0;
            }
                $totalTrans = $transCountU + $transURC;
            return view('transactionhistory', compact('transU', 'transCountU', 'transUR', 'transURC', 'totalTrans'));
        } elseif(Auth::check() && Auth::user()->role == "consultant") {
            // Consultant View
            if(Transaction::where('consultations.consultant_id', Auth::id())->join('consultations', 'transactions.consultation_id', 'consultations.id')
            ->exists()){
                $transC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->latest('transactions.created_at')
                ->select('transactions.id', 'title', 'amount', 'transaction_datetime', 'consultations.consultant_id')
                ->paginate(3, ['*'], 'transC');

                $transCountC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->count('transactions.id');

                $transSumC = Transaction::where('consultations.consultant_id', Auth::id())
                ->where('transactions.status', 'success')
                ->join('consultations', 'transactions.consultation_id', 'consultations.id')
                ->sum('amount');

                if(Withdraw::where('user_id', Auth::id())->exists()){
                    $transWithdraw = Withdraw::where('user_id', Auth::id())
                    ->where('type', 'withdraw')->sum('amount');
                    $transW = Withdraw::where('user_id', Auth::id())
                    ->where('type', 'withdraw')
                    ->latest('withdraws.created_at')
                    ->select()->paginate(3, ['*'], 'transW');
                    $transCountW = Withdraw::where('user_id', Auth::id())
                    ->where('type', 'withdraw')->count('id');
                } else {
                    $transW = "";
                    $transWithdraw = 0;
                    $transCountW = 0;
                }
                
                if($transRefund = Withdraw::where('consultations.consultant_id', Auth::id())
                ->join('transactions', 'transaction_id', 'transactions.id')
                ->join('consultations', 'consultation_id', 'consultations.id')
                ->where('withdraws.type', 'refund')->exists()) {
                    $transRefund = Withdraw::where('consultations.consultant_id', Auth::id())
                    ->join('transactions', 'transaction_id', 'transactions.id')
                    ->join('consultations', 'consultation_id', 'consultations.id')
                    ->where('withdraws.status', 'success')
                    ->where('withdraws.type', 'refund')->sum('withdraws.amount');
                    
                    $transRC= Withdraw::where('consultations.consultant_id', Auth::id())
                    ->join('transactions', 'transaction_id', 'transactions.id')
                    ->join('consultations', 'consultation_id', 'consultations.id')
                    ->where('withdraws.type', 'refund')
                    ->latest('withdraws.created_at')
                    ->select('withdraws.id', 'withdraws.amount', 'withdraws.status',
                    'withdraws.type', 'withdraws.created_at')->paginate(3, ['*'], 'transRC');

                    $transCountRC = Withdraw::where('consultations.consultant_id', Auth::id())
                    ->join('transactions', 'transaction_id', 'transactions.id')
                    ->join('consultations', 'consultation_id', 'consultations.id')
                    ->where('withdraws.type', 'refund')->count('withdraws.id');
                } else {
                    $transRefund = 0;
                    $transRC = "";
                    $transCountRC = 0;
                }
                $transWallet = $transSumC - $transWithdraw - $transRefund;
            } else {
                $transC = "";
                $transCountC = 0;
                $transWallet = 0;
                $transCountRC = 0;
                $transCountW = 0;
                $transW = "";
                $transRC = "";
            } $totalTrans = $transCountC + $transCountRC + $transCountW;
            return view('transactionhistory', compact('transC', 'transCountC', 'transWallet',
                'transCountW', 'transW', 'transRC', 'transCountRC', 'totalTrans'));
        } else {
            return redirect()->route('login')->with('success', "Login First");
        }
    }

    public function viewFeedback(){
        if(Auth::check() && Auth::user()->role == "consultant"){
            if(ConsultationFeedback::where('consultant_id', Auth::id())->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
            ->exists()) {
                $feedbacks = ConsultationFeedback::where('consultant_id', Auth::id())
                ->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->join('users', 'consultations.user_id', 'users.id')
                ->latest('consultation_feedback.created_at')
                ->select('rating', 'comment', 'user_id', 'title', 'name')->paginate(9);

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
        return redirect()->back()->with('success',"Add Refund Success");
    }

    public function addWithdraw(Request $request){
        $wt = new Withdraw();
        $wt->user_id = $request->user_id;
        $wt->bank_acc = $request->bank_acc; 
        $wt->amount = $request->amount;
        $wt->type = $request->type;
        $wt->status = $request->status;
        $wt->save();
        return redirect()->back()->with('success',"Add Withdraw Success");
    }

}
