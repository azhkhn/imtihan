<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\ClassRoom\StoreRequestClassRoom;
use App\Http\Requests\Admin\ClassRoom\UpdateRequestClassRoom;
use App\Http\Resources\Admin\ClassRoomResource;
use App\Services\Admin\ClassRoomService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ClassRoomController extends ApiController
{
    public function __construct(ClassRoomService $service)
    {
        $this->classRoomService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(ClassRoomResource::collection($this->classRoomService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequestClassRoom  $request
     * @return JsonResponse
     */
    public function store(StoreRequestClassRoom $request): JsonResponse
    {
        $this->classRoomService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $class_room
     * @return JsonResponse
     */
    public function show($class_room): JsonResponse
    {
        return $this->successResponse(new ClassRoomResource($this->classRoomService->show($class_room)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequestClassRoom  $request
     * @param  int  $class_room
     * @return JsonResponse
     */
    public function update(UpdateRequestClassRoom $request, $class_room): JsonResponse
    {
        $this->classRoomService->update($request, $class_room);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $class_room
     * @return JsonResponse
     */
    public function destroy($class_room): JsonResponse
    {
        $this->classRoomService->destroy($class_room);

        return $this->successResponse([], __('response.deleted'));
    }
}
