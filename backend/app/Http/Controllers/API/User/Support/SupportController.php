<?php

namespace App\Http\Controllers\API\User\Support;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\User\Support\StoreSupportRequest;
use App\Http\Requests\User\Support\UpdateSupportRequest;
use App\Http\Resources\User\Support\SupportResource;
use App\Services\User\Support\SupportService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SupportController extends ApiController
{
    public function __construct(SupportService $service)
    {
        $this->supportService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('user.support.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(SupportResource::collection($this->supportService->list([], ['company_id' => Helper::userInfo()->company_id, 'user_id' => auth()->id()])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupportRequest  $request
     * @return JsonResponse
     */
    public function store(StoreSupportRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('user.support.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['company_id' => Helper::userInfo()->company_id, 'user_id' => auth()->id()]);
        $this->supportService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $support
     * @return JsonResponse
     */
    public function show(int $support): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupportRequest  $support
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateSupportRequest $request, $support): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $support
     * @return JsonResponse
     */
    public function destroy($support): JsonResponse
    {
        //
    }
}
