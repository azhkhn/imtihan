<?php

namespace App\Http\Controllers\API\Admin\Question;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Question\StoreQuestionCategoryRequest;
use App\Http\Requests\Admin\Question\StoreQuestionRequest;
use App\Http\Requests\Admin\Question\UpdateQuestionCategoryRequest;
use App\Http\Requests\Admin\Question\UpdateQuestionRequest;
use App\Http\Resources\Admin\Question\QuestionResource;
use App\Services\Admin\Question\QuestionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends ApiController
{

    public function __construct(QuestionService $service)
    {
        $this->questionService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        abort_unless(auth()->user()->tokenCan('admin.question.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(QuestionResource::collection($this->questionService->list(['category', 'language', 'options'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuestionCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(StoreQuestionRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $question
     * @return JsonResponse
     */
    public function show($question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new QuestionResource($this->questionService->show($question, ['category', 'language', 'options'])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateQuestionCategoryRequest  $request
     * @param  int  $question
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request, $question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->update($request, $question);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $question
     * @return JsonResponse
     */
    public function destroy($question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.question.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->destroy($question);

        return $this->successResponse([], __('response.deleted'));
    }
}
