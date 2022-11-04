<?php

namespace App\Services\Admin\Question;

use App\Models\Question;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\DB;

class QuestionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Question::class);
    }

    public function create($request): void
    {
        DB::transaction(function () use ($request) {
            $question = $this->model::create($request->validated());

            $question->options()->createMany($request->options);
        });
    }

    public function update($request, int $id, $where = []): void
    {
        $question = $this->model::findOrFail($id);
        DB::transaction(function () use ($request, $question) {
            $question->update($request->validated());

            $question->options()->delete();

            $question->options()->createMany($request->options);
        });
    }
}
