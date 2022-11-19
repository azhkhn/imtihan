<?php

namespace App\Http\Controllers\API\User\Booking;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Teacher\Booking\UpdateBookingRequest;
use App\Http\Requests\User\Booking\StoreBookingRequest;
use App\Http\Resources\User\Booking\BookingResource;
use App\Services\User\Booking\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
        abort_unless(auth()->user()->tokenCan('user.booking.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(BookingResource::collection($this->bookingService->list([], ['company_id' => Helper::userInfo()->company_id, 'user_id' => auth()->id()])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookingRequest  $request
     * @return JsonResponse
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('user.booking.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id, 'user_id' => auth()->id()]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $booking
     * @return JsonResponse
     */
    public function destroy($booking): JsonResponse
    {
        //
    }
}
