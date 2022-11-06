<?php

namespace App\Http\Controllers\API\Manager\Booking;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\Booking\StoreBookingSettingRequest;
use App\Http\Requests\Manager\Booking\UpdateBookingSettingRequest;
use App\Http\Resources\Manager\Booking\BookingSettingResource;
use App\Services\Manager\Booking\BookingSettingService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookingSettingController extends ApiController
{
    public function __construct(BookingSettingService $service)
    {
        $this->bookingSettingService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking-setting.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(BookingSettingResource::collection($this->bookingSettingService->list([], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookingSettingRequest  $request
     * @return JsonResponse
     */
    public function store(StoreBookingSettingRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking-setting.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->bookingSettingService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $booking_setting
     * @return JsonResponse
     */
    public function show(int $booking_setting): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking-setting.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new BookingSettingResource($this->bookingSettingService->show($booking_setting, [], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookingSettingRequest  $request
     * @param  int  $booking_setting
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function update(UpdateBookingSettingRequest $request, $booking_setting): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking-setting.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->authorize('update', $this->bookingSettingService->show($booking_setting));

        $this->bookingSettingService->update($request, $booking_setting);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $booking_setting
     * @return JsonResponse
     */
    public function destroy($booking_setting): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking-setting.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->authorize('delete', $this->bookingSettingService->show($booking_setting));

        $this->bookingSettingService->destroy($booking_setting);

        return $this->successResponse([], __('response.deleted'));
    }
}
