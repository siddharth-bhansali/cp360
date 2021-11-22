@extends('index')

@section('document-title', 'Fill Form')
@section('header-form', 'active')

@section('content')
    <div class="col-md-8 col-lg-6 mx-auto card shadow border-0 p-4">
        @if(count($fields))
            <h1 class="text-center">Fill Form</h1>
            <form method="post" action="{{ route('forms.store') }}">
                @csrf
                @foreach($fields as $field)
                    @switch($field->type)
                        @case('text')
                        @case('number')
                        @case('email')
                        @case('password')
                        <div class="form-group mb-3">
                            <label for="{{ $field->name }}" class="form-label">{{ $field->label }}</label>
                            <input type="{{ $field->type }}" class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" placeholder="{{ $field->label }}" required>
                            @error($field->name)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @break

                        @case('select')
                        <div class="form-group mb-3">
                            <label for="{{ $field->name }}" class="form-label">{{ $field->label }}</label>
                            <select class="form-select" id="{{ $field->name }}" name="{{ $field->name }}" required>
                                @foreach($field->options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error($field->name)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @break

                        @case('checkbox')
                        <div class="form-group mb-3">
                            <label for="{{ $field->name }}" class="form-label me-3">{{ $field->label }}</label>
                            @foreach($field->options as $option)
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $field->name }}" name="{{ $field->name }}[]" value="{{ $option }}">
                                    <label class="form-check-label" for="{{ $field->name }}">{{ $option }}</label>
                                </div>
                            @endforeach
                            @error($field->name)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @break
                    @endswitch
                @endforeach
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </form>
        @else
            <h1 class="text-center">No Form Available.</h1>
        @endif
    </div>
@endsection
