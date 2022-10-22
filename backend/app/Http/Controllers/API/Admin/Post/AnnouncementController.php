<?php

namespace App\Http\Controllers\API\Admin\Post;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Post\StoreAnnouncementRequest;
use App\Http\Requests\Admin\Post\UpdateAnnouncementRequest;
use App\Http\Resources\Admin\Post\AnnouncementResource;
use App\Services\Admin\Post\AnnouncementService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnnouncementController extends ApiController
{
    public function __construct(AnnouncementService $service)
    {
        $this->announcementService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.announcement.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(AnnouncementResource::collection($this->announcementService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAnnouncementRequest  $request
     * @return JsonResponse
     */
    public function store(StoreAnnouncementRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.announcement.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->announcementService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $announcement
     * @return JsonResponse
     */
    public function show(int $announcement): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.announcement.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new AnnouncementResource($this->announcementService->show($announcement)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAnnouncementRequest  $announcement
     * @param  int  $announcement
     * @return JsonResponse
     */
    public function update(UpdateAnnouncementRequest $request, $announcement): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.announcement.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->announcementService->update($request, $announcement);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $announcement
     * @return JsonResponse
     */
    public function destroy($announcement): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.announcement.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->announcementService->destroy($announcement);

        return $this->successResponse([], __('response.deleted'));
    }
}
