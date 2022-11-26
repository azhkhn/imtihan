<?php

namespace App\Http\Controllers\API\Manager\Exam;

use App\Helper\Helper;
use App\Http\Controllers\API\ApiController;
use App\Http\Resources\Manager\Exam\ReportResource;
use App\Models\Report;
use App\Services\Manager\Exam\ReportService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends ApiController
{

    public function __construct(ReportService $service)
    {
        $this->reportService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.exam.report.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(
            ReportResource::collection($this->reportService->list(['category.questionCategory', 'user'],
                ['company_id' => Helper::userInfo()->company_id])));
    }

    /**
     * Display the specified resource.
     *
     * @param int $report
     * @return JsonResponse
     */
    public function show(int $report): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('manager.exam.report.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new ReportResource($this->reportService->show($report, ['category.questionCategory', 'user'])));
    }
}
