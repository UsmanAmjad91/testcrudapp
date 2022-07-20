<?php
namespace App\Providers;
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\ServiceProvider;
use App\Providers\AppServiceProvider\Paginator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'product_code' => 'required|unique:products',
            'product_name' => 'required',
            'product_price' => 'required',
        ]);
        // dd($request->all());
        
        $product = new Product();
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $res = $product->save();

        if (!empty($res))
            return json_encode(array('message' => 'Product Added successfully', 'status' => 200));

        else
            return json_encode(array('message' => 'Produst Not Inserted', 'status' => 500));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = Product::orderBy('created_at', 'desc')->cursorPaginate(10)->withQueryString();;
       $pagination= (string)$product->links();
        if ($request->ajax())
{
     
 $data = [
  'data' => $product,
  'pagination' => $pagination,
 ];
// dd($data);

    return json_encode($data);
}
        // $product = Product::paginate(8);
        // cursorPaginate(10)->withQueryString();
        // $data = Product::select('product_id', 'product_code', 'product_name', 'product_price')->orderBy('created_at', 'desc')->get();
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
       // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_code_edit' => 'required',
            'product_name_edit' => 'required',
            'product_price_edit' => 'required',
        ]);
        if (!empty($id)) {

            $is_update = Product::where('product_id', $id)->update([
                'product_code' => $request->product_code_edit,
                'product_name' => $request->product_name_edit,
                'product_price'=> $request->product_price_edit,
            ]);
        }
        if (!empty($is_update))
            return json_encode(array('message' => 'Product Update successfully', 'status' => 200));
        else
            return json_encode(array('message' => 'Product  Not Update', 'status' => 500));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        // dd($id);
        if (!empty($id)) {
            $is_delete = Product::where('product_id', $id)->delete();

            if (!empty($is_delete))
                return json_encode(array('message' => 'Record Deleted successfully', 'status' => 200));
            else
                return json_encode(array('message' => 'Record  Not Deleted', 'status' => 500));
        }
    }
}
