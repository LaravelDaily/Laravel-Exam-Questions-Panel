@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="question">{{ trans('cruds.question.fields.question') }}</label>
                <input class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question" id="question" value="{{ old('question', '') }}" required>
                @if($errors->has('question'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.question.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', '1') }}" step="1">
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer_explanation">{{ trans('cruds.question.fields.answer_explanation') }}</label>
                <input class="form-control {{ $errors->has('answer_explanation') ? 'is-invalid' : '' }}" type="text" name="answer_explanation" id="answer_explanation" value="{{ old('answer_explanation', '') }}">
                @if($errors->has('answer_explanation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer_explanation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.answer_explanation_helper') }}</span>
            </div>
            <div class="card" id="app">
                <div class="card-header">
                    {{ trans('cruds.questionOption.title') }}
                </div>
                <question-options :old-option-text='@json(old('option_text', ['']))' :old-is-correct='@json(old('is_correct', []))'></question-options>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endsection
