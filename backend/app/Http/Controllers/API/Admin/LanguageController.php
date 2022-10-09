<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use App\Http\Resources\Admin\LanguageResource;
use App\Services\Admin\LanguageService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends ApiController
{
    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return LanguageResource::collection($this->service->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Language\LanguageStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageStoreRequest $request): \Illuminate\Http\Response
    {
        $this->service->create($request);

        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $language
     * @return LanguageResource
     */
    public function show($language)
    {
        return new LanguageResource($this->service->show($language));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Language\LanguageUpdateRequest  $request
     * @param  int  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageUpdateRequest $request, $language): \Illuminate\Http\Response
    {
        $this->service->update($request, $language);

        return response()->noContent(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($language): \Illuminate\Http\Response
    {
        $this->service->destroy($language);

        return response()->noContent(Response::HTTP_OK);
    }
}
