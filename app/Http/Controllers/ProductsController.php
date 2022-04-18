<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = categories::all()->pluck('name_category', 'id_category');
        return view('product.index', compact('category'));
    }

    public function data()
    {
        $product = products::leftJoin('categories', 'categories.id_category', 'products.id_category')
            ->select('products.*', 'name_category')
            ->orderBy('id_product', 'desc')
            ->get();
        
        return dataTables()
            ->of($product)
            ->addIndexColumn()
            ->addColumn('select_all', function ($product) {
                return '<input type="checkbox" name="id_product[]" value="'. $product->id_product .'" >';
            })
            ->addColumn('code_product', function ($product) {
                return '<span class="badge bg-success">' . $product->code_product . '</span>';
            })
            ->addColumn('purchase_price', function ($product) {
                return format_uang($product->purchase_price);
            })
            ->addColumn('selling_price', function ($product) {
                return format_uang($product->selling_price);
            })
            ->addColumn('stock', function ($product) {
                return format_uang($product->stock);
            })
            ->addColumn('action', function ($product) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('Products.update', $product->id_product) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('Products.destroy', $product->id_product) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'code_product', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kode produk
        $product = products::latest()->first()  ?? new products();
        $request['code_product'] = 'P' . tambah_nol_didepan((int)$product->id_product +1, 6);
        
        $product = products::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = products::find($id);

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = products::find($id);
        $product->update($request->all());

        return response()->json('data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = products::find($id);
        $product->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
       
        foreach ($request->id_product as $id) {
            $product = products::find($id);
            $product->delete();
        
        }
        
        return response(null, 204);

    }
}
