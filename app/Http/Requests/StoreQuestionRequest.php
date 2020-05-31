<?php

namespace App\Http\Requests;

use App\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'question'    => [
                'required',
            ],
            'points'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'option_text' => [
                'required',
                'array',
            ],
            'option_text.*' => [
                'required',
                'string'
            ],
            'is_correct' => [
                'required',
                'array',
            ],
            'is_correct.*' => [
                'required',
                'boolean',
            ]
        ];
    }

    public function messages()
    {
        return [
            'is_correct.required' => 'Question must have at least one correct option.'
        ];
    }
}
