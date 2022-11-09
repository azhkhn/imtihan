<?php

namespace App\Services\Manager\Lesson;

use App\Helper\Helper;
use App\Models\Lesson;
use App\Models\LessonByCompany;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\DB;

class LessonService extends BaseService
{
    public function __construct()
    {
        parent::__construct(LessonByCompany::class);
    }

    public function show($id, $with = [], $where = [])
    {
        return $this->model::with($with)->where($where)->whereLessonId($id)->firstOrFail();
    }

    public function create($request): void
    {
        DB::transaction(function () use ($request) {
            $lesson = Lesson::create($request->validated());

            $this->model::create([
                'lesson_id' => $lesson->id,
                'company_id' => Helper::userInfo()->company_id,
            ]);
        });
    }

    public function update($request, int $id, $where = []): void
    {
        $lesson = $this->model::whereLessonId($id)->firstOrFail();
        DB::transaction(function () use ($request, $lesson) {
            $lesson->lesson->update($request->validated());
        });
    }

    public function destroy($id, $where = []): void
    {
        $lesson = $this->model::wherelessonId($id)->firstOrFail();
        DB::transaction(function () use ($lesson) {
            $lesson->lesson->delete();
            $lesson->delete();
        });
    }
}
