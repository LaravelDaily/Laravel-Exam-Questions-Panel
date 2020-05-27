<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuestionOptionRequest;
use App\Http\Requests\StoreQuestionOptionRequest;
use App\Http\Requests\UpdateQuestionOptionRequest;
use App\Question;
use App\QuestionOption;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionOptionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('question_option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionOptions = QuestionOption::all();

        return view('admin.questionOptions.index', compact('questionOptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('question_option_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.questionOptions.create', compact('questions'));
    }

    public function store(StoreQuestionOptionRequest $request)
    {
        $questionOption = QuestionOption::create($request->all());

        return redirect()->route('admin.question-options.index');
    }

    public function edit(QuestionOption $questionOption)
    {
        abort_if(Gate::denies('question_option_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questionOption->load('question');

        return view('admin.questionOptions.edit', compact('questions', 'questionOption'));
    }

    public function update(UpdateQuestionOptionRequest $request, QuestionOption $questionOption)
    {
        $questionOption->update($request->all());

        return redirect()->route('admin.question-options.index');
    }

    public function show(QuestionOption $questionOption)
    {
        abort_if(Gate::denies('question_option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionOption->load('question');

        return view('admin.questionOptions.show', compact('questionOption'));
    }

    public function destroy(QuestionOption $questionOption)
    {
        abort_if(Gate::denies('question_option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionOption->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuestionOptionRequest $request)
    {
        QuestionOption::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
