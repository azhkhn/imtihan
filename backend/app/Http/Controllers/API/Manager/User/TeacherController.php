<?php

namespace App\Http\Controllers\API\Manager\User;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\User\StoreTeacherRequest;
use App\Http\Requests\Manager\User\UpdateTeacherRequest;
use App\Http\Resources\Manager\User\TeacherResource;
use App\Models\User;
use App\Services\Manager\User\TeacherService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends ApiController
{
    public function __construct(TeacherService $service)
    {
        $this->teacherService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.user.teacher.list'),
            Response::HTTP_FORBIDDEN
        );
        return $this->successResponse(TeacherResource::collection($this->teacherService->list([], ['role' => User::Teacher])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTeacherRequest  $request
     * @return JsonResponse
     */
    public function store(StoreTeacherRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.user.teacher.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['role' => User::Teacher]);

        $this->teacherService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $teacher
     * @return JsonResponse
     */
    public function show(int $teacher): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.user.teacher.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new TeacherResource($this->teacherService->show($teacher)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTeacherRequest  $request
     * @param  int  $teacher
     * @return JsonResponse
     */
    public function update(UpdateTeacherRequest $request, $teacher): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.user.teacher.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->teacherService->update($request, $teacher);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $teacher
     * @return JsonResponse
     */
    public function destroy($teacher): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.user.teacher.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->teacherService->destroy($teacher);

        return $this->successResponse([], __('response.deleted'));
    }
}
