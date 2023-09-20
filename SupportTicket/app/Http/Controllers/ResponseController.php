<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;

class ResponseController extends Controller
{
    public function index()
    {
        return response(ResponseResource::collection(Response::all()));
    }

    public function store(StoreResponseRequest $request)
    {
        $validated = $request -> validated();

        $this -> authorize("create", Response::class);

        Response::create($validated);

        return response(ResponseResource::collection(Response::all()));
    }

    public function update(UpdateResponseRequest $request, Response $response)
    {
        $validated = $request -> validated();

        $this -> authorize("update", Response::class);

        $response -> update($validated);

        return response(ResponseResource::collection(Response::all()));
    }
}
