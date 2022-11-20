<?php

namespace App\Http\Controllers\API\Manager\Notification;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\Notification\StoreNotificationRequest;
use App\Http\Resources\Manager\Notification\NotificationResource;
use App\Services\Manager\Notification\NotificationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends ApiController
{
    public function __construct(NotificationService $service)
    {
        $this->notificationService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.notification.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(NotificationResource::collection($this->notificationService->list([], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreNotificationRequest  $request
     * @return JsonResponse
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.notification.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id]);
        $this->notificationService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }
}
