<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Requests\StoreUpdateOrderFormRequest;
use App\Mail\SendMailUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Repository;

class OrderController extends Controller
{
    protected $model;
    private $product;
    private $customer;

    public function __construct(Order $order, Product $product, Customer $customer)
    {
        $this->model = new Repository($order);
        $this->product = $product;
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->model->all();

        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOrderFormRequest $request)
    {
        $data = $request->all();
      
        $customer = $this->customer->find($data['customer_id']);

        if (!$customer) {
            return response()->json(['error' => "Customer not found!"]);
        }

        $product = $this->product->find($data['product_id']);
        
        if (!$product) {
            return response()->json(['error' => "Product not found!"]);
        }
       
        $order = $this->model->create($data);

        $order_data = [
            'name' => $customer->name,
            'product' => $product
        ];

        if ($order) {
            Mail::to($customer->email)->send(new SendMailUser($order_data));
        }

        return response()->json(['success' => $order], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $order = $this->model->find($id);

        if(!$order)
            return response()->json(['error' => 'Not found'], 404);
        
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOrderFormRequest $request, $id)
    {
        $order = $this->model->find($id);

        if(!$order)
            return response()->json(['error' => 'Not found'], 404);

        $order = $this->model->update($request->all(), $id);
        
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->model->find($id);

        if (!$order) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        $this->model->delete($order);

        return response()->json(['success' => true], 204);
    }
}
