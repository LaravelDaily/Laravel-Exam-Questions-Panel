<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionOptionRequest;
use App\Http\Requests\UpdateQuestionOptionRequest;
use App\Http\Resources\Admin\QuestionOptionResource;
use App\QuestionOption;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionOptionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('question_option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuestionOptionResource(QuestionOption::with(['question'])->get());
    }

    public function store(StoreQuestionOptionRequest $request)
    {
        $questionOption = QuestionOption::create($request->all());

        return (new QuestionOptionResource($questionOption))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QuestionOption $questionOption)
    {
        abort_if(Gate::denies('question_option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuestionOptionResource($questionOption->load(['question']));
    }

    public function update(UpdateQuestionOptionRequest $request, QuestionOption $questionOption)
    {
        $questionOption->update($request->all());

        return (new QuestionOptionResource($questionOption))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QuestionOption $questionOption)
    {
        abort_if(Gate::denies('question_option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionOption->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
