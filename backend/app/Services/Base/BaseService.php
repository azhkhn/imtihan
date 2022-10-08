<?php

namespace App\Services\Base;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BaseService
{

    /**
     * @var string
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        return $this->model::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\LanguageRequest  $request
     * @return Response
     */
    public function create($request): Response
    {
        $this->model::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        return $this->model::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int  $id
     */
    public function update($request, $id): void
    {
        $this->model::findOrFail($id)->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id): void
    {
        $this->model::findOrFail($id)->delete();
    }
}
