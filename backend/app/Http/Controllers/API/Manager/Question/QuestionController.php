<?php

namespace App\Http\Controllers\API\Manager\Question;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\Question\StoreQuestionRequest;
use App\Http\Requests\Manager\Question\UpdateQuestionRequest;
use App\Http\Resources\Manager\Question\QuestionResource;
use App\Services\Manager\QuestionService;
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
        abort_unless(auth()->user()->tokenCan('manager.question.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(QuestionResource::collection($this->questionService->list(['question.options'], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQuestionRequest $request
     * @return JsonResponse
     */
    public function store(StoreQuestionRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.question.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $question
     * @return JsonResponse
     */
    public function show($question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.question.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new QuestionResource($this->questionService->show($question, ['question.options'], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $request
     * @param int $question
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request, $question)
    {
        abort_unless(auth()->user()->tokenCan('manager.question.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->update($request, $question);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $question
     * @return JsonResponse
     */
    public function destroy($question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.question.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->destroy($question);

        return $this->successResponse([], __('response.deleted'));
    }
}
