<?php

namespace App\Http\Controllers\API\Admin\Company;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\StoreCompanyUserRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyUserRequest;
use App\Http\Resources\Admin\Company\CompanyUserResource;
use App\Models\User;
use App\Services\Admin\Company\CompanyUserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyUserController extends ApiController
{
    public function __construct(CompanyUserService $service)
    {
        $this->userService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.user.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(CompanyUserResource::collection($this->userService->list([], ['role' => User::Manager])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompanyRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCompanyUserRequest $request)
    {
        abort_unless(auth()->user()->tokenCan('admin.company.user.create'),
            Response::HTTP_FORBIDDEN
        );

        $request->merge(['role' => User::Manager]);

        $this->userService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return JsonResponse
     */
    public function show($user): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.user.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new CompanyUserResource($this->userService->show($user)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyUserRequest $request
     * @param  int  $user
     * @return JsonResponse
     */
    public function update(UpdateCompanyUserRequest $request, $user)
    {
        abort_unless(auth()->user()->tokenCan('admin.company.user.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->userService->update($request, $user);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $user
     * @return JsonResponse
     */
    public function destroy($user)
    {
        abort_unless(auth()->user()->tokenCan('admin.company.user.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->userService->destroy($user);

        return $this->successResponse([], __('response.deleted'));
    }
}
