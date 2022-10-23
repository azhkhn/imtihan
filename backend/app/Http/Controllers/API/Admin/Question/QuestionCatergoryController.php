<?php

namespace App\Http\Controllers\API\Admin\Question;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Question\StoreQuestionCategoryRequest;
use App\Http\Requests\Admin\Question\UpdateQuestionCategoryRequest;
use App\Http\Resources\Admin\Question\QuestionCategoryResource;
use App\Services\Admin\Question\QuestionCategoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionCatergoryController extends ApiController
{
    public function __construct(QuestionCategoryService $service)
    {
        $this->questionCategoryService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.category.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(QuestionCategoryResource::collection($this->questionCategoryService->list(['childrens'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuestionCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(StoreQuestionCategoryRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.category.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionCategoryService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return JsonResponse
     */
    public function show($category)
    {
        abort_unless(auth()->user()->tokenCan('admin.question.category.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new QuestionCategoryResource($this->questionCategoryService->show($category)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateQuestionCategoryRequest  $request
     * @param  int  $category
     * @return JsonResponse
     */
    public function update(UpdateQuestionCategoryRequest $request, $category)
    {
        abort_unless(auth()->user()->tokenCan('admin.question.category.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionCategoryService->update($request, $category);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return JsonResponse
     */
    public function destroy($category): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.category.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionCategoryService->destroy($category);

        return $this->successResponse([], __('response.deleted'));
    }
}
