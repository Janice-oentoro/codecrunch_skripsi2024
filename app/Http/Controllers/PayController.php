<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use stdClass;

class PayController extends Controller
{
    public function showView(Request $request){
        if (!Auth::user()) {
            return redirect('/login');
        }
        // $findConsultationId = Transaction::where('id', 3)->select('consultation_id')->first();
        // dd($findConsultationId->consultation_id);

        $user = new stdClass();
        $user->id = Auth::user()->id; 
        $user->name = Auth::user()->name;
        $user->email = Auth::user()->email;

        $id = $request->pay;
        $cons = Consultation::where('consultations.id', $id)->join('users', 'consultations.consultant_id', '=', 'users.id')->select('consultations.id', 'title','price', 'avatar', 'consult_datetime')
        ->first();
        #dd($cons);
        
        return view('pay', compact('user','cons'));
    }

    public function pay(Request $request)
    {
        $id = $request->consultationId;
        $c = Consultation::where('consultations.id', $id)->join('users', 'consultations.consultant_id', '=', 'users.id')->select('consultations.id', 'title','price', 'avatar', 'consult_datetime')
        ->first();
        $item = new stdClass();
        $item->id = $id;
        $item->price = $c->price;
        $item->name = $c->title;
        $item->merchant_name = "CodeCrunch";
        
        $grossAmount = $item->price;

        $trans = Transaction::create([
            'consultation_id' => $item->id,
            'user_id' => Auth::user()->id,
            'transaction_datetime' => now(),
            'amount' => $grossAmount,
            'status' => 'ongoing'
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $trans->id,
                'gross_amount' => $grossAmount
            ),

            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        // $snapToken = 'abcde';

        // dd($snapToken, $params);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function callback(Request $request){
        $server_key = config('midtrans.server_key');
        
        $sign_key = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $server_key);
 
        if ($sign_key == $request->signature_key){
            // Transaction::where('id',$request->order_id)->update([
            //     'status' => 'success'
            // ]);
            $status = Transaction::where('id', $request->order_id)->
            select('status')->get();
            
            if($request->transaction_status == "capture" && $status == 'ongoing'){
                Transaction::where('id',$request->order_id)->update([
                    'status' => 'success'
                ]);

                $findConsultationId = Transaction::where('id',$request->order_id)->select('consultation_id')->first();
                Consultation::where('id', $findConsultationId->consultation_id)->update([
                    'status' => 'coming soon'
                ]);
                
                // $trans = Transaction::find($request->order_id);
                // $trans->update(['status' => 'success']);
            }

            else{
                Transaction::where('id',$request->order_id)->update([
                    'status' => 'fail'
                ]);
                // $trans = Transaction::find($request->order_id);
                // $trans->update(['status' => 'failed']);
            }
        }
        return true;
    }
}
