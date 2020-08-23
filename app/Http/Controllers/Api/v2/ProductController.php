<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Repository;

class ProductController extends Controller
{
    private $product;
    protected $model;
    protected $image;
    
    public function __construct(Product $product)
    {
        $this->model = new Repository($product);
        $this->image = new ImageRepository($product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->model->all();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();

        $uploadedImage = $this->image->doUpload($request);

        if (!$uploadedImage) {            
            return response()->json(['error' => 'Image upload fail!'], 500);
        }        

        $data['image'] = $uploadedImage;

        $product = $this->model->create($data);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $product = $this->model->find($id);

        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $uploadedImage = $this->image->doUpload($request);
        
        $data = $request->all();
        
        if (!$uploadedImage) {            
            return response()->json(['error' => 'Image upload fail!'], 500);
        }
        
        $data['image'] = $uploadedImage;
        
        $product = $this->model->update($data, $id);
        
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }
              
        $this->model->delete($product);

        return response()->json(['success' => true], 204);
    }
}
