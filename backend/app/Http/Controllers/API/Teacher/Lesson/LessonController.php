<?php

namespace App\Http\Controllers\API\Teacher\Lesson;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Teacher\Lesson\StoreLessonRequest;
use App\Http\Requests\Teacher\Lesson\UpdateLessonRequest;
use App\Http\Resources\Teacher\Lesson\LessonResource;
use App\Services\Teacher\Lesson\LessonService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends ApiController
{
    public function __construct(LessonService $service)
    {
        $this->lessonService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.lesson.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(LessonResource::collection($this->lessonService->list([], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLessonRequest  $request
     * @return JsonResponse
     */
    public function store(StoreLessonRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.lesson.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id]);
        $this->lessonService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $lesson
     * @return JsonResponse
     */
    public function show(int $lesson): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.lesson.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new LessonResource($this->lessonService->show($lesson, ['lesson'], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLessonRequest  $request
     * @param    $lesson
     * @return JsonResponse
     */
    public function update(UpdateLessonRequest $request, $lesson): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.lesson.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->lessonService->update($request, $lesson);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $lesson
     * @return JsonResponse
     */
    public function destroy($lesson): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.lesson.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->lessonService->destroy($lesson);

        return $this->successResponse([], __('response.deleted'));
    }
}
