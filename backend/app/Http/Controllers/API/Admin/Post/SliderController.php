<?php

namespace App\Http\Controllers\API\Admin\Post;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Post\StoreSliderRequest;
use App\Http\Requests\Admin\Post\UpdateSliderRequest;
use App\Http\Resources\Admin\Post\SliderResource;
use App\Services\Admin\Post\SliderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends ApiController
{
    public function __construct(SliderService $service)
    {
        $this->sliderService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.slider.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(SliderResource::collection($this->sliderService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSliderRequest  $request
     * @return JsonResponse
     */
    public function store(StoreSliderRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.slider.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->sliderService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slider
     * @return JsonResponse
     */
    public function show(int $slider): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.slider.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new SliderResource($this->sliderService->show($slider)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSliderRequest  $slider
     * @param  int  $slider
     * @return JsonResponse
     */
    public function update(UpdateSliderRequest $request, $slider): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.slider.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->sliderService->update($request, $slider);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slider
     * @return JsonResponse
     */
    public function destroy($slider): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.post.slider.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->sliderService->destroy($slider);

        return $this->successResponse([], __('response.deleted'));
    }
}
