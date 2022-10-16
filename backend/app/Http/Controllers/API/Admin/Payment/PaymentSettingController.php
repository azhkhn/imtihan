<?php

namespace App\Http\Controllers\API\Admin\Payment;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Payment\StorePaymentSettingRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentSettingRequest;
use App\Http\Resources\Admin\Payment\PaymentSettingResource;
use App\Services\Admin\Payment\PaymentSettingService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentSettingController extends ApiController
{
    public function __construct(PaymentSettingService $service)
    {
        $this->paymentSettingService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-setting.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(PaymentSettingResource::collection($this->paymentSettingService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentSettingRequest  $request
     * @return JsonResponse
     */
    public function store(StorePaymentSettingRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-setting.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentSettingService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $payment_setting
     * @return JsonResponse
     */
    public function show(int $payment_setting): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-setting.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new PaymentSettingResource($this->paymentSettingService->show($payment_setting)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentSettingRequest  $payment_setting
     * @param  int  $payment_setting
     * @return JsonResponse
     */
    public function update(UpdatePaymentSettingRequest $request, $payment_setting): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-setting.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentSettingService->update($request, $payment_setting);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $payment_setting
     * @return JsonResponse
     */
    public function destroy($payment_setting)
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-setting.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentSettingService->destroy($payment_setting);

        return $this->successResponse([], __('response.deleted'));
    }
}
