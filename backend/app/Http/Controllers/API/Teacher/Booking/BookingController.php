<?php

namespace App\Http\Controllers\API\Teacher\Booking;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Teacher\Booking\StoreBookingRequest;
use App\Http\Requests\Teacher\Booking\UpdateBookingRequest;
use App\Http\Resources\Teacher\Booking\BookingResource;
use App\Services\Teacher\Booking\BookingService;
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
        abort_unless(auth()->user()->tokenCan('teacher.booking.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(BookingResource::collection($this->bookingService->list([], ['company_id' => Helper::userInfo()->company_id, 'teacher_id' => auth()->id()])));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $booking
     * @return JsonResponse
     */
    public function show(int $booking): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.booking.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new BookingResource($this->bookingService->show($booking, [],
            ['company_id' => Helper::userInfo()->company_id, 'teacher_id' => auth()->id()])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $booking
     * @return JsonResponse
     */
    public function destroy($booking): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('teacher.booking.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->authorize('delete', $this->bookingService->show($booking));

        $this->bookingService->destroy($booking);

        return $this->successResponse([], __('response.deleted'));
    }
}
