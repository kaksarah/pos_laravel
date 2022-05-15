<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Sales;


class DashboardController extends Controller
{
    public function index()
    {
        $category = Categories::count();
        $product = Products::count();
        $sales = Sales::count();

        
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');

        $date_time = array();

        $date_income = array();

        while (strtotime($start_date) <= strtotime($end_date))
        {
            
            $date_time[] = (int) substr($start_date, 8, 2);
            

            $total_sale = Sales::where('created_at', 'LIKE', "%$start_date%")->sum('pay');

            $income = $total_sale;
            $date_income[] += $income;

            $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));

        }

        $start_date = date('Y-m-01');


        if(auth()->user()->level == 1) {

            return view('admin.dashboard', compact('category', 'product', 'sales', 'start_date', 'end_date', 'date_time', 'date_income'));

        } else {
            if (auth()->user()->level == 2) {

                return view('manager.dashboard', compact('category', 'product', 'sales', 'start_date', 'end_date', 'date_time', 'date_income'));

            } else {

                return view('cashier.dashboard', compact('sales', 'start_date', 'end_date', 'date_time', 'date_income'));

            }
            
        }
    }
}
