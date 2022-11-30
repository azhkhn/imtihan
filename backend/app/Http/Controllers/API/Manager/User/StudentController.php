<?php

namespace App\Http\Controllers\API\Manager\User;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\User\StoreStudentRequest;
use App\Http\Requests\Manager\User\UpdateStudentRequest;
use App\Http\Resources\Manager\User\StudentResource;
use App\Models\User;
use App\Services\Manager\User\StudentService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends ApiController
{
    public function __construct(StudentService $service)
    {
        $this->studentService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.student.list'),
            Response::HTTP_FORBIDDEN
        );
        return $this->successResponse(StudentResource::collection($this->studentService->list([], ['role' => User::Student])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest  $request
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.student.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['role' => User::Student]);

        $this->studentService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $student
     * @return JsonResponse
     */
    public function show(int $student): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.student.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new StudentResource($this->studentService->show($student)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentRequest  $request
     * @param  int  $student
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, $student): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.student.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->studentService->update($request, $student);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $student
     * @return JsonResponse
     */
    public function destroy($student): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.student.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->studentService->destroy($student);

        return $this->successResponse([], __('response.deleted'));
    }
}
