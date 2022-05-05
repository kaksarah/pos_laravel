<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\SalesDetail;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use DataTables;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::orderBy('name_product')->get();

        // Cek apakah ada transaksi yang sedang berjalan
        if ($id_sale = session('id_sale')) {
            return view('sale_detail.index', compact('product', 'id_sale'));
        } else {
            if (auth()->user()->level == 0) {
                return redirect()->route('transaction.new');
            } else { 
                return redirect()->route('home');
            }
        }

       

        
    }

    public function data($id)
    {
        $detail = SalesDetail::with('product')
            ->where('id_sale', $id)
            ->get();


        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['code_product'] = '<span class="label label-success">'. $item->product['code_product'] .'</span';
            $row['name_product'] = $item->product['name_product'];
            $row['selling_price'] = 'Rp. ' . format_uang($item->selling_price);
            $row['total']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_sale_details .'" value="'. $item->total .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['action']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('Transaction.destroy', $item->id_sale_details) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->selling_price * $item->total;
            $total_item += $item->total;
        }
        $data[] = [
            'code_product'  => '
                                <div class="total hide">'. $total .'</div>
                                <div class="total_item hide">'. $total_item .'</div>',
            'name_product'  => '',
            'selling_price' => '',
            'total'         => '',
            'subtotal'      => '',
            'action'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'code_product', 'total'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $product = Products::where('id_product', $request->id_product)->first();
        if (! $product) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new SalesDetail();
        $detail->id_sale = $request->id_sale;
        $detail->id_product = $product->id_product;
        $detail->selling_price = $product->selling_price;
        $detail->total = 1;
        $detail->subtotal = $product->selling_price;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = SalesDetail::find($id);
        $detail->total = $request->total;
        $detail->subtotal = $detail->selling_price * $request->total;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = SalesDetail::find($id);
        $detail->delete();
    }

    public function loadForm($total, $diterima)
    {
        $kembali = ($diterima != 0) ? $diterima - $total : 0;
        $data    = [
            'totalrp' => format_uang($total),
            'terbilang' => ucwords(terbilang($total). ' Rupiah'),
            'kembalirp' => format_uang($kembali),
            'kembali_terbilang' => ucwords(terbilang($kembali). ' Rupiah'),
            
        ];

        return response()->json($data);
    }


   
    

   
    
}
