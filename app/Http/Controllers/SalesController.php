<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Products;


class SalesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return "Ok";
    }
    
    public function create()
    {
        $sale = new Sales();
        $sale->total_items  = 0;
        $sale->total_price  = 0;
        $sale->pay          = 0;
        $sale->accepted     = 0;
        $sale->id_user      = auth()->id();
        $sale->save();

        session(['id_sale' => $sale->id_sale]);
        return redirect()->route('Transaction.index');
    }

    public function store(Request $request)
    {
        $sale = Sales::findOrFail($request->id_sale);
        $sale->total_items = $request->total_item;
        $sale->total_price = $request->total;
        $sale->pay = $request->total;
        $sale->accepted = $request
        $sale->update();

        $detail = SalesDetail::where('id_sale', $sale->id_sale)->get();
        foreach ($detail as $item) {
            $product = Products::find($item->id_product);
            $product->stock -= $item->total;
            $product->update();
        }

        return redirect()->route('sales.index');
    }
}
