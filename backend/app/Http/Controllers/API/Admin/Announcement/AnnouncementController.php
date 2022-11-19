<?php

namespace App\Http\Controllers\API\Admin\Announcement;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Announcement\StoreAnnouncementRequest;
use App\Http\Requests\Admin\Announcement\UpdateAnnouncementRequest;
use App\Http\Resources\Admin\Announcement\AnnouncementResource;
use App\Services\Admin\Announcement\AnnouncementService;
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
        abort_unless(auth()->user()->tokenCan('admin.announcement.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(AnnouncementResource::collection($this->announcementService->list([], ['company_id' => null])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAnnouncementRequest  $request
     * @return JsonResponse
     */
    public function store(StoreAnnouncementRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.announcement.create'),
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
        abort_unless(auth()->user()->tokenCan('admin.announcement.show'),
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
        abort_unless(auth()->user()->tokenCan('admin.announcement.update'),
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
        abort_unless(auth()->user()->tokenCan('admin.announcement.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->announcementService->destroy($announcement);

        return $this->successResponse([], __('response.deleted'));
    }
}
