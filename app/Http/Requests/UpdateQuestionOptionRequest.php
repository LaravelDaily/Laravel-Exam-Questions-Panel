<?php

namespace App\Http\Requests;

use App\QuestionOption;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateQuestionOptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('question_option_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'question_id' => [
                'required',
                'integer',
            ],
            'option_text' => [
                'required',
            ],
        ];
    }
}
