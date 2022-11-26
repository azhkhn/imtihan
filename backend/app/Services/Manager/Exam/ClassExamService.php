<?php

namespace App\Services\Manager\Exam;

use App\Models\ClassExam;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\DB;

class ClassExamService extends BaseService
{
    public function __construct()
    {
        parent::__construct(ClassExam::class);
    }

    public function create($request): void
    {
        DB::transaction(function () use ($request) {
            $classExam = $this->model::create($request->validated());

            $classExam->classExamCategories()->createMany($request->categories);
        });
    }

    public function update($request, $id, $where = []): void
    {
        $classExam = $this->model::findOrFail($id);
        DB::transaction(function () use ($request, $id, $classExam) {
            $classExam->update($request->validated());

            $classExam->classExamCategories()->delete();

            $classExam->classExamCategories()->createMany($request->categories);
        });
    }

    public function destroy($id, $where = []): void
    {
        $classExam = $this->model::findOrFail($id);
        DB::transaction(function () use ($id, $classExam) {
            $classExam->classExamCategories()->delete();
            $classExam->delete();
        });
    }
}
