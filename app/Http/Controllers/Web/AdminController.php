<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Visit;
use App\Models\Payment;

class AdminController extends Controller
{
    public function home(){
        $all_count_users = collect(User::all())->count();
        $count_users = collect(User::all()->where('firstname','!=',null))->count();
        $partial_count_users = collect(User::all()->where('firstname',null))->count();
        $paidUsersCount = Payment::all()->count();
    	
        $user_joined_today_count = User::whereDate('created_at', now()->toDateString())->where('firstname','!=',null)->count();
        
        $onlineUsersCount = User::where('last_active_at', '>=', now()->subMinutes(5))->count();

        // $percent_online_user_count = ( $onlineUsersCount * 100 ) / $count_users;
        // $percent_today_count_users = ( $user_joined_today_count * 100 ) / $count_users; 

         if ($count_users > 0) {
            // Calculate percentages
            $percent_online_user_count = ($onlineUsersCount * 100) / $count_users;
            $percent_today_count_users = ($user_joined_today_count * 100) / $count_users;
            $percentPaidUsersCount = ($paidUsersCount * 100) / $count_users;
        } else {
            // Default values if $count_users is zero
            $percent_online_user_count = 0;
            $percent_today_count_users = 0;
            $percentPaidUsersCount = 0;
        }

        #start of visit count
        $todaysVisitCount = Visit::whereDate('date', Carbon::today())->sum('count');    
        $yesterdaysVisitCount = Visit::whereDate('date', Carbon::yesterday())->sum('count');
        $allVisitCount = Visit::all()->sum('count');
        #end of visit count

        return view('Users.admin.home',[
            'allUsersCount' => $all_count_users,
            'partialCountUsers' => $partial_count_users,
            'user_joined_today_count' => $user_joined_today_count,
            'online_user_count' => $onlineUsersCount,
            'percent_online_user_count' => substr(number_format($percent_online_user_count, 2, '.', ''), 0, -1).'%',
            'percent_user_joined_today' => substr(number_format($percent_today_count_users, 2, '.', ''), 0, -1).'%',
            'todaysVisitCount' => $todaysVisitCount,
            'yesterdaysVisitCount' => $yesterdaysVisitCount,
            'allVisitCount' => $allVisitCount,
            'paidUsersCount' => $paidUsersCount,
            'percentPaidUsersCount' => $percentPaidUsersCount,
    	]);
    }

    public function refresh_counts(){
        $all_count_users = collect(User::all())->count();
        $count_users = collect(User::all()->where('firstname','!=',null))->count();
        $partial_count_users = collect(User::all()->where('firstname',null))->count();
        
        $onlineUsersCount = User::where('last_active_at', '>=', now()->subMinutes(5))->count();

        // $percent_online_user_count = ( $onlineUsersCount * 100 ) / $count_users;

        #start User_joined_today
        // $user_joined_today_count = User::whereDate('created_at', now()->toDateString())->count();
        // $percent_user_joined_today = ( $user_joined_today_count * 100 ) / $count_users;
        #end User_joined_today
        if ($count_users > 0) {
            $percent_online_user_count = ($onlineUsersCount * 100) / $count_users;
        } else {
            $percent_online_user_count = 0;
        }

        #start User_joined_today
        $user_joined_today_count = User::whereDate('created_at', now()->toDateString())->where('firstname','!=',null)->count();
        // $percent_user_joined_today = ( $user_joined_today_count * 100 ) / $count_users;
        if ($count_users > 0) {
            $percent_user_joined_today = ($user_joined_today_count * 100) / $count_users;
        } else {
            $percent_user_joined_today = 0;
        }

        #start visit count
        $todaysVisitCount = Visit::whereDate('date', Carbon::today())->sum('count');    
        $yesterdaysVisitCount = Visit::whereDate('date', Carbon::yesterday())->sum('count');

        $allVisitCount = Visit::all()->sum('count');
        #end of visit count

        function todaysVisitCountFN($todaysVisitCount) {
            if ($todaysVisitCount >= 1000000000) {
                // For billions
                return number_format($todaysVisitCount / 1000000000, 1) . 'B';
            } elseif ($todaysVisitCount >= 1000000) {
                // For millions
                return number_format($todaysVisitCount / 1000000, 1) . 'M';
            } elseif ($todaysVisitCount >= 1000) {
                // For thousands
                return number_format($todaysVisitCount / 1000, 1) . 'K';
            } else {
                // Return the number as is if it's less than 1000
                return $todaysVisitCount;
            }
        }

        function yesterdaysVisitCountFN($yesterdaysVisitCount) {
            if ($yesterdaysVisitCount >= 1000000000) {
                // For billions
                return number_format($yesterdaysVisitCount / 1000000000, 1) . 'B';
            } elseif ($yesterdaysVisitCount >= 1000000) {
                // For millions
                return number_format($yesterdaysVisitCount / 1000000, 1) . 'M';
            } elseif ($yesterdaysVisitCount >= 1000) {
                // For thousands
                return number_format($yesterdaysVisitCount / 1000, 1) . 'K';
            } else {
                // Return the number as is if it's less than 1000
                return $yesterdaysVisitCount;
            }
        }

        function allVisitCountFN($allVisitCount) {
            if ($allVisitCount >= 1000000000) {
                // For billions
                return number_format($allVisitCount / 1000000000, 1) . 'B';
            } elseif ($allVisitCount >= 1000000) {
                // For millions
                return number_format($allVisitCount / 1000000, 1) . 'M';
            } elseif ($allVisitCount >= 1000) {
                // For thousands
                return number_format($allVisitCount / 1000, 1) . 'K';
            } else {
                // Return the number as is if it's less than 1000
                return $allVisitCount;
            }
        }

        return response()->json([
            'allUsersCount' => $all_count_users,
            'partialCountUsers' => $partial_count_users,
            'online_user_count' => $onlineUsersCount,
            'percent_online_user_count' => substr(number_format($percent_online_user_count, 2, '.', ''), 0, -1).'%',
            'user_joined_today_count' => $user_joined_today_count,
            'percent_user_joined_today' => substr(number_format($percent_user_joined_today, 2, '.', ''), 0, -1).'%',
            'todaysVisitCount' => todaysVisitCountFN($todaysVisitCount),
            'yesterdaysVisitCount' => yesterdaysVisitCountFN($yesterdaysVisitCount),
            'allVisitCount' => allVisitCountFN($allVisitCount),
        ]);

    }

    public function display_paid_users(Request $request){
        
        // $users = User::where('firstname','!=',null)->orderBy('user_code','desc')->paginate(10);

        $payments = Payment::with('user')->paginate(10);
        $totatAmount = Payment::all()->sum('amount');
        $count_payee = collect(Payment::all())->count();
        $count = 1;
        return view('Users.admin.paid_users', [
            'payments' => $payments,
            'totatAmount' => $totatAmount,
            'count_payee' => $count_payee,
            'count' => $count,
        ]);
    }

    public function search_users_payment(Request $request){
        
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->Where('user_code', 'like', "%$search%")
                  ->orWhere('firstname', 'like', "%$search%")
                  ->orWhere('lastname', 'like', "%$search%");
            });
        }
        $users = $query->paginate(10);
        return view('Users.admin.SearchUser_ready_ToPay', compact('users'));
    }

    public function assign_payment_ToUser($id){
        $user_id=Crypt::decrypt($id);
        $users = User::all()->where('id',$user_id);
        return view('Users.admin.assign_payment_ToUser',[
            'user_id' => $user_id,
            'users' => $users
        ]);
    }

    // public function submit_payment_ToUser(Request $request,$id){
    //     $request->validate([
    //         'amount' => 'required|numeric',
    //         'duration' => 'required|integer|min:1',
    //     ]);

    //     $user_id = $id;
    //     $currentDate = Carbon::now();

    //     $payment = new Payment();
    //     $payment->user_id = $user_id;
    //     $payment->amount = $request->amount;
    //     $payment->duration = $request->duration;
    //     $payment->start_date = $currentDate;
    //     $payment->end_date = $currentDate->copy()->addMonths($request->duration);
    //     $payment->active_days = $request->duration * 30;
    //     $payment->save();

    //     return redirect()->route('admin.display_paid_users')->with(
    //         'info' , 'Payment created successfully',
    //     );
    // }

    public function submit_payment_ToUser(Request $request, $id){
        $request->validate([
            'amount' => 'required|numeric',
            'duration' => 'required|integer|min:1',
        ]);

        $user_id = $id;
        $currentDate = Carbon::now();

        // Find the latest payment for the user
        $latestPayment = Payment::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestPayment) {
            $endDate = Carbon::parse($latestPayment->end_date);

            if ($currentDate->lessThanOrEqualTo($endDate)) {
                return redirect()->back()->with('error', 'User already has an active subscription. Please wait until it expires.');
            }
        }

        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->amount = $request->amount;
        $payment->duration = $request->duration;
        $payment->start_date = $currentDate;
        $payment->end_date = $currentDate->copy()->addMonths($request->duration);
        $payment->active_days = $request->duration * 30;
        $payment->save();

        return redirect()->route('owner.display_paid_users')->with(
            'info', 'Payment created successfully'
        );
    }

    public function view_all_users(){
        $users = User::where('firstname','!=',null)->paginate(10);
        $count_users = $users->count();

        return view('Users.admin.view_all_users',compact('users','count_users'));
    }

    public function view_all_users_joined_today(){
        $users = User::whereDate('created_at', now()->toDateString())->where('firstname','!=',null)->paginate(10);

        $count_users = $users->count();

        return view('Users.admin.view_all_users_joined_today',compact('users','count_users'));
    }


}
