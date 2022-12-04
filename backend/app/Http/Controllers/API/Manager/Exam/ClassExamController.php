<?php

namespace App\Http\Controllers\API\Manager\Exam;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\Exam\StoreClassExamRequest;
use App\Http\Requests\Manager\Exam\UpdateClassExamRequest;
use App\Http\Resources\Manager\Exam\ClassExamResource;
use App\Services\Manager\Exam\ClassExamService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ClassExamController extends ApiController
{
    public function __construct(ClassExamService $service)
    {
        $this->classExamService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.class-exam.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(ClassExamResource::collection($this->classExamService->list(['classExamCategories'],
            ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreClassExamRequest  $request
     * @return JsonResponse
     */
    public function store(StoreClassExamRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.class-exam.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id]);
        $this->classExamService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $class_exam
     * @return JsonResponse
     */
    public function show(int $class_exam): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.class-exam.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new ClassExamResource($this->classExamService->show($class_exam, ['classExamCategories'])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateClassExamRequest  $request
     * @param  int  $class_exam
     * @return JsonResponse
     */
    public function update(UpdateClassExamRequest $request, int $class_exam): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.class-exam.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->classExamService->update($request, $class_exam);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $class_exam
     * @return JsonResponse
     */
    public function destroy(int $class_exam): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.class-exam.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->classExamService->destroy($class_exam);

        return $this->successResponse([], __('response.deleted'));
    }
}
