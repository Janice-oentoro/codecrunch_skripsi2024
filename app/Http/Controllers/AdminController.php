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

class AdminController extends Controller
{
    //
}
