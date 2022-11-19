<?php

namespace App\Http\Controllers\API\Admin\Lesson;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Lesson\StoreLessonRequest;
use App\Http\Requests\Admin\Lesson\UpdateLessonRequest;
use App\Http\Resources\Admin\Lesson\LessonResource;
use App\Services\Admin\Lesson\LessonService;
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
        abort_unless(auth()->user()->tokenCan('admin.lesson.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(LessonResource::collection($this->lessonService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLessonRequest  $request
     * @return JsonResponse
     */
    public function store(StoreLessonRequest $request)
    {
        abort_unless(auth()->user()->tokenCan('admin.lesson.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->lessonService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $lesson
     * @return JsonResponse
     */
    public function show($lesson): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.lesson.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new LessonResource($this->lessonService->show($lesson)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLessonRequest  $request
     * @param  int  $lesson
     * @return JsonResponse
     */
    public function update(UpdateLessonRequest $request, $lesson): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.lesson.update'),
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
        abort_unless(auth()->user()->tokenCan('admin.lesson.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->lessonService->destroy($lesson);

        return $this->successResponse([], __('response.deleted'));
    }
}
