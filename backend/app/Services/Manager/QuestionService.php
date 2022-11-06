<?php

namespace App\Services\Manager;

use App\Helper\Helper;
use App\Models\Question;
use App\Models\QuestionByCompany;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(QuestionByCompany::class);
    }

    public function show($id, $with = [], $where = [])
    {
        return $this->model::with($with)->where($where)->whereQuestionId($id)->firstOrFail();
    }

    public function create($request): void
    {
        DB::transaction(function () use ($request) {
            $question = Question::create($request->validated());
            $question->options()->createMany($request->options);

            $this->model::create([
                'question_id' => $question->id,
                'company_id' => Helper::userInfo()->company_id,
            ]);
        });
    }

    public function update($request, int $id, $where = []): void
    {
        $question = $this->model::whereQuestionId($id)->firstOrFail();
        DB::transaction(function () use ($request, $question) {
            $question->question->update($request->validated());
            $question->question->options()->delete();
            $question->question->options()->createMany($request->options);
        });
    }

    public function destroy($id, $where = []): void
    {
        $question = $this->model::whereQuestionId($id)->firstOrFail();
        DB::transaction(function () use ($question) {
            $question->question->options()->delete();
            $question->question->delete();
            $question->delete();
        });
    }
}
