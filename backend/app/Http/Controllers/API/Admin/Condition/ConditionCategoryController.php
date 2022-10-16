<?php

namespace App\Http\Controllers\API\Admin\Condition;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Condition\StoreConditionCategoryRequest;
use App\Http\Requests\Admin\Condition\UpdateConditionCategoryRequest;
use App\Http\Resources\Admin\Condition\ConditionCategoryResource;
use App\Services\Admin\Condition\ConditionCategoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ConditionCategoryController extends ApiController
{
    public function __construct(ConditionCategoryService $service)
    {
        $this->conditionCategoryService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.condition-category.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(ConditionCategoryResource::collection($this->conditionCategoryService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreConditionCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(StoreConditionCategoryRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.condition-category.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->conditionCategoryService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $condition_category
     * @return JsonResponse
     */
    public function show($condition_category): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.condition-category.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new ConditionCategoryResource($this->conditionCategoryService->show(($condition_category))));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateConditionCategoryRequest  $request
     * @param  int  $condition_category
     * @return JsonResponse
     */
    public function update(UpdateConditionCategoryRequest $request, $condition_category): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.condition-category.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->conditionCategoryService->update($request, $condition_category);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $condition_category
     * @return JsonResponse
     */
    public function destroy($condition_category): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.condition-category.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->conditionCategoryService->destroy($condition_category);

        return $this->successResponse([], __('response.deleted'));
    }
}
