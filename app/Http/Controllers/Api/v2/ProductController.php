<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $pastel;
    private $upload_path = 'products';

    public function __construct(Product $pastel)
    {
        $this->pastel = $pastel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->pastel->getProducts();

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

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $data['image'] = $this->pastel->makeImageName($request, 'image');      

            $uploaded = $request->image->storeAs($this->upload_path, $data['image']);

            if (!$uploaded)
                return response()->json(['error' => 'Upload fail!'], 500);
        }
        $pastel = $this->pastel->create($data);

        return response()->json($pastel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $pastel = $this->pastel->find($id);

        if(!$pastel)
            return response()->json(['error' => 'Not found'], 404);
        
        return response()->json($pastel);
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
        $pastel = $this->pastel->find($id);

        if(!$pastel)
            return response()->json(['error' => 'Not found'], 404);

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            if ($pastel->image) {
                $filePath = "{$this->upload_path}/{$pastel->image}";
                if(Storage::exists($filePath))
                {
                    Storage::delete($filePath);
                }
            }

            $data['image'] = $this->pastel->makeImageName($request, 'image');      
            
            $uploaded = $request->image->storeAs('products', $data['image']);

            if (!$uploaded)
                return response()->json(['error' => 'Upload fail!'], 500);
        }

        $pastel->update($data);
        
        return response()->json($pastel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pastel = $this->pastel->find($id);

        if(!$pastel)
            return response()->json(['error' => 'Not found'], 404);
        
        if ($pastel->image) {
            $filePath = "{$this->upload_path}/{$pastel->image}";
            if(Storage::exists($filePath))
            {
                Storage::delete($filePath);
            }
        }      
              
        $pastel->delete();

        return response()->json(['success' => true], 204);
    }
}
