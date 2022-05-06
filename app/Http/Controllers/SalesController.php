<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Products;
use App\Models\Setting;
use PDF;


class SalesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        return view('sale.index');
    }

    public function data()
    {
        $sale = Sales::orderBy('id_sale', 'desc')->get();

        return datatables()
            ->of($sale)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($sale) {
                return tanggal_indonesia($sale->created_at, false);
            })
            ->addColumn('total_items', function ($sale) {
                return format_uang($sale->total_items);
            })
            ->addColumn('total_price', function ($sale) {
                return 'Rp. '. format_uang($sale->total_price);
            })
            ->addColumn('pay', function ($sale) {
                return 'Rp. '. format_uang($sale->pay);
            })
            ->addColumn('kasir', function ($sale) {
                return $sale->user->name ?? '';
            })
            ->addColumn('action', function ($sale) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('sales.show', $sale->id_sale) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('sales.destroy', $sale->id_sale) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $sale->accepted = $request->diterima;
        $sale->update();

        $detail = SalesDetail::where('id_sale', $sale->id_sale)->get();
        foreach ($detail as $item) {
            $product = Products::find($item->id_product);
            $product->stock -= $item->total;
            $product->update(); 
        }

        return redirect()->route('transaction.end');
    }

    public function show($id)
    {
        $detail = SalesDetail::with('product')->where('id_sale', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code_product', function ($detail) {
                return '<span class="label label-success">'. $detail->product->code_product .'</span>';
            })
            ->addColumn('name_product', function ($detail) {
                return $detail->product->name_product;
            })
            ->addColumn('selling_price', function ($detail) {
                return 'Rp. '. format_uang($detail->selling_price);
            })
            ->addColumn('total', function ($detail) {
                return format_uang($detail->total);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['code_product'])
            ->make(true);
    }

    public function destroy($id)
    {
        $sale = Sales::find($id);
        $detail    = SalesDetail::where('id_sale', $sale->id_sale)->get();
        foreach ($detail as $item) {
            $product = Products::find($item->id_product);
            if ($product) {
                $product->stock += $item->total;
                $product->update();
            }
            $item->delete();
        }

        $sale->delete();

        return response(null, 204);
    }

    public function end()
    {
        $setting = Setting::first();

        return view('sale.end', compact('setting'));
    }

    public function notaSmall() 
    {
        $setting    = Setting::first();
        $sale       = Sales::find(session('id_sale'));
        if (! $sale) {
            abort(404);
        }
        $detail     = SalesDetail::with('product')
            ->where('id_sale', session('id_sale'))
            ->get();

        return view('sale.nota_small', compact('setting', 'sale', 'detail'));
    }

    public function notaBig() 
    {
        $setting    = Setting::first();
        $sale       = Sales::find(session('id_sale'));
        if (! $sale) {
            abort(404);
        }
        $detail     = SalesDetail::with('product')
            ->where('id_sale', session('id_sale'))
            ->get();

        return view('sale.nota_big', compact('setting', 'sale', 'detail'));

        $pdf = pdf::loadView(sale.nota_big, compact('setting', 'sale', 'detail'));
        $pdf->setPaper(0,0,600,400, 'potrait');
        return $pdf->stream();
    }
}
