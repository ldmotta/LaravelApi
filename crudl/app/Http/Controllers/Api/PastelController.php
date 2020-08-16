<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pastel;
use App\Http\Requests\StoreUpdatePastelFormRequest;

class PastelController extends Controller
{
    private $pastel;
    public function __construct(Pastel $pastel)
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
        $pasteis = $this->pastel->getPasteis();

        return response()->json($pasteis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePastelFormRequest $request)
    {
        $pastel = $this->pastel->create($request->all());

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
    public function update(StoreUpdatePastelFormRequest $request, $id)
    {
        $pastel = $this->pastel->find($id);

        if(!$pastel)
            return response()->json(['error' => 'Not found'], 404);

        $pastel->update($request->all());
        
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
        
        $pastel->delete();

        return response()->json(['success' => true], 204);
    }
}
