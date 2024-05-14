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
use App\Models\User;
use Carbon\Carbon; #GET CURRENT TIME
use Laravel\Ui\Presets\React;

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
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('name', 'LIKE', "%$search%")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filtertopic != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($search != "" && $filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")
            ->where('name', 'LIKE', "%$search%")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } elseif($filtertopic != "" && $filterprog != "") {
            $users = User::where('role', 'consultant')
            ->join('topic_consultants', 'consultant_id', '=', 'users.id')
            ->join('topics', 'topic_id', '=', 'topics.id')
            ->join('prog_consultants', 'consultant_id', '=', 'users.id')
            ->join('programmings', 'prog_id', '=', 'programmings.id')
            ->where('prog_name', 'LIKE', "$filterprog")
            ->where('topic_name', 'LIKE', "$filtertopic")->distinct()
            ->get(['users.id', 'name', 'price', 'avatar']);
        } else {
            $users = User::where('role', 'consultant')
            ->get(['users.id', 'name', 'price','avatar']);
        }
        return view('land', compact('users', 'search', 'filterprog'));
    }

    public function detailConsultant(Request $request){
        $udtl = User::findOrFail($request->id);
        return view('detailconsultant', compact('udtl'));
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
            return view('consultation', compact('cus', 'ccss', 'cogs', 'cufs'));
        } #Consultant view 
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
            return view('consultation', compact('ccus', 'cccss', 'ccogs', 'ccfs'));
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
        $c = new Consultation();
        $c->user_id = $request->user_id;
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

    public function deleteCon(Request $request)
    {
        Consultation::where('id', $request->consultation_id)->delete();
        return redirect()->back()->with('success',"Delete Success");
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
            return redirect()->back()->with('success', 'Edit Profile Success');
    }
}
