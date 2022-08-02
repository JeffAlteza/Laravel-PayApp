<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment_transaction;
use Carbon\Carbon;


class DashboardController extends Controller
{

//Amount gathered from all transactions
    public function getTotalAmountMonday(){
        $monday = Carbon::now()->startOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $monday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $monday], 200);
    }

    public function getTotalAmountTuesday(){
        $tuesday = Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $tuesday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $tuesday], 200);
    }

    public function getTotalAmountWednesday(){
        $wednesday = Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $wednesday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $wednesday], 200);
    }

    public function getTotalAmountThursday(){
        $thursday = Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $thursday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $thursday], 200);
    }

    public function getTotalAmountFriday(){
        $friday = Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $friday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $friday], 200);
    }

    public function getTotalAmountSaturday(){
        $saturday = Carbon::now()->startOfWeek()->addDays(5)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $saturday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $saturday], 200);
    }

    public function getTotalAmountSunday(){
        $sunday = Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $sunday)->sum('amount');
        return response()->json(['total' => $total, 'day' => $sunday], 200);
    }

    public function TotalAmountThisWeek()
    {
        $total = payment_transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        return response()->json(['total' => $total]);
    }
    
    public function TotalAmountThisMonth()
    {
        $month = date('F');
        $total = payment_transaction::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount');
        return response()->json(['total' => $total, 'month' => $month]);
    }

    public function TotalAmountThisYear()
    {
        $total = payment_transaction::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount');
        return response()->json(['total' => $total]);
    }


 
//Weeks
    public function week1(){
        $firstWeek = Carbon::now()->startOfMonth()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->sum('amount');
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

    public function week2(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->sum('amount');
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

    public function week3(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->sum('amount');
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

    public function week4(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->sum('amount');
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

//Transaction Count
//Weeks
public function count_week1(){
    $firstWeek = Carbon::now()->startOfMonth()->startOfWeek()->format('Y-m-d');
    $lastWeek = Carbon::now()->startOfMonth()->endOfWeek()->format('Y-m-d');
    $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->count();
    return response()->json([
        'firstWeek' => $firstWeek, 
        'lastWeek' => $lastWeek,
        'total' => $total
    ], 200);
}

    public function count_week2(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->count();
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

    public function count_week3(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->count();
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }

    public function count_week4(){
        $firstWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->addWeek()->startOfWeek()->format('Y-m-d');
        $lastWeek = Carbon::now()->startOfMonth()->addWeek()->addWeek()->addWeek()->endOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereBetween('created_at', [$firstWeek, $lastWeek])->count();
        return response()->json([
            'firstWeek' => $firstWeek, 
            'lastWeek' => $lastWeek,
            'total' => $total
        ], 200);
    }


    public function TotalNumberThisMonth()
    {
        $current_month = payment_transaction::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        return response()->json(['total' => $current_month]);
    }

    public function TotalNumberThisYear()
    {
        $current_year = payment_transaction::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        return response()->json(['total' => $current_year]);
    }

//days
    public function getTotalNumberMonday(){
        $monday = Carbon::now()->startOfWeek()->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $monday)->count();
        return response()->json(['total' => $total, 'day' => $monday], 200);
    }

    public function getTotalNumberTuesday(){
        $tuesday = Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $tuesday)->count();
        return response()->json(['total' => $total, 'day' => $tuesday], 200);
    }   

    public function getTotalNumberWednesday(){
        $wednesday = Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $wednesday)->count();
        return response()->json(['total' => $total, 'day' => $wednesday], 200);
    }

    public function getTotalNumberThursday(){
        $thursday = Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $thursday)->count();
        return response()->json(['total' => $total, 'day' => $thursday], 200);
    }

    public function getTotalNumberFriday(){
        $friday = Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $friday)->count();
        return response()->json(['total' => $total, 'day' => $friday], 200);
    }

    public function getTotalNumberSaturday(){
        $saturday = Carbon::now()->startOfWeek()->addDays(5)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $saturday)->count();
        return response()->json(['total' => $total, 'day' => $saturday], 200);
    }

    public function getTotalNumberSunday(){
        $sunday = Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d');
        $total = payment_transaction::whereDate('created_at', $sunday)->count();
        return response()->json(['total' => $total, 'day' => $sunday], 200);
    }



}
