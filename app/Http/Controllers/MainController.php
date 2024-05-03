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

    public function land() {
        session();
        $users = User::where('role', 'consultant')
        ->get(['users.id', 'name', 'price']);
        return view('land', compact('users'));
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
            $cusers = Consultation::where('user_id', Auth::id())
            ->join('users', 'consultant_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime']);
            return view('consultation', compact('cusers'));
        } #Consultant view 
        elseif(Auth::check() && Auth::user()->role == "consultant"){
            $cconsults = Consultation::where('consultant_id', Auth::id())
            ->join('users', 'user_id', '=', 'users.id')
            ->get(['title', 'desc', 'type', 'status', 'link', 'name', 'consultations.id', 'consult_datetime', 'end_consult_datetime']);
            return view('consultation', compact('cconsults'));
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
