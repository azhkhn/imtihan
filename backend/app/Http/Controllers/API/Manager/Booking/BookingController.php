<?php

namespace App\Http\Controllers\API\Manager\Booking;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Manager\Booking\StoreBookingRequest;
use App\Http\Requests\Manager\Booking\UpdateBookingRequest;
use App\Http\Resources\Manager\Booking\BookingResource;
use App\Services\Manager\Booking\BookingService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends ApiController
{
    public function __construct(BookingService $service)
    {
        $this->bookingService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(BookingResource::collection($this->bookingService->list([], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookingRequest  $request
     * @return JsonResponse
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id]);
        $this->bookingService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $booking
     * @return JsonResponse
     */
    public function show(int $booking): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new BookingResource($this->bookingService->show($booking, [], ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookingRequest  $booking
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateBookingRequest $request, $booking): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->authorize('update', $this->bookingService->show($booking));

        $this->bookingService->update($request, $booking);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $booking
     * @return JsonResponse
     */
    public function destroy($booking): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.booking.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->authorize('delete', $this->bookingService->show($booking));

        $this->bookingService->destroy($booking);

        return $this->successResponse([], __('response.deleted'));
    }
}
