<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use App\Http\Resources\Admin\LanguageResource;
use App\Services\Admin\LanguageService;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(LanguageResource::collection($this->service->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LanguageStoreRequest $request
     * @return JsonResponse
     */
    public function store(LanguageStoreRequest $request): JsonResponse
    {
        $this->service->create($request);

        return $this->successResponse([], 'Language created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $language
     * @return JsonResponse
     */
    public function show($language): JsonResponse
    {
        return $this->successResponse(new LanguageResource($this->service->find($language)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LanguageUpdateRequest $request
     * @param  int  $language
     * @return JsonResponse
     */
    public function update(LanguageUpdateRequest $request, $language): JsonResponse
    {
        $this->service->update($request, $language);

        return $this->successResponse([], 'Language updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $language
     * @return JsonResponse
     */
    public function destroy($language): JsonResponse
    {
        $this->service->destroy($language);

        return $this->successResponse([], 'Language deleted successfully');
    }
}
