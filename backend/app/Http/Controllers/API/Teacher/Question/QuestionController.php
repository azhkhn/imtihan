<?php

namespace App\Http\Controllers\API\Teacher\Question;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Teacher\Question\StoreQuestionRequest;
use App\Http\Requests\Teacher\Question\UpdateQuestionRequest;
use App\Http\Resources\Manager\Question\QuestionBugResource;
use App\Http\Resources\Teacher\Question\QuestionResource;
use App\Services\Teacher\Question\QuestionService;
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
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(QuestionResource::collection($this->questionService->list(['question.options'], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuestionRequest  $request
     * @return JsonResponse
     */
    public function store(StoreQuestionRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id]);
        $this->questionService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $question
     * @return JsonResponse
     */
    public function show(int $question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new QuestionResource($this->questionService->show($question, ['question.options'], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQuestionRequest $request
     * @param int $question
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request, int $question)
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.update'),
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
    public function destroy(int $question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->destroy($question);

        return $this->successResponse([], __('response.deleted'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getBugList(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.bug.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(QuestionBugResource::collection($this->questionService->getBugList()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroyBug(int $question): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.question.bug.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->questionService->destroyBug($question);

        return $this->successResponse([], __('response.deleted'));
    }
}
