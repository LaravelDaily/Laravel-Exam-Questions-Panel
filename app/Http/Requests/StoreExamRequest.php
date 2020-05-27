<?php

namespace App\Http\Requests;

use App\Exam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreExamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'             => [
                'required',
            ],
            'questions_amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'categories.*'     => [
                'integer',
            ],
            'categories'       => [
                'required',
                'array',
            ],
        ];
    }
}
