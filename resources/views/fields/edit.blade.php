@extends('index')

@section('document-title', 'Create')
@section('header-form', 'active')

@section('content')
    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3 card shadow border-0  p-4">
        <div class="add-fields-block">
            <div class="border-bottom border-2 pb-2 mb-4 d-flex align-items-center justify-content-between">
                <h1>Edit Field</h1>
                <a href="{{ route('fields.create') }}" class="btn btn-outline-primary">Back</a>
            </div>
            <form method="post" action="{{ route('fields.update', $field->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $field->label) }}" required>
                            @error('label')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name (alpha-numeric only)</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $field->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                @php
                                    $type_check = old('type') ?? $field->type;
                                @endphp
                                @foreach(config('settings.input_types') as $type)
                                    <option value="{{ $type }}" @if($type_check === $type) selected @endif>{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" id="options-block" style="display: none;">
                        <div class="form-label mb-2">Options</div>
                        <div class="mb-3 row g-2">
                            @for($i = 1; $i < 7; $i++)
                                <div class="col-sm-4">
                                    <label for="option-{{ $i }}" class="form-label d-none">Options</label>
                                    <input type="text" class="form-control" id="option-{{ $i }}" name="options[]" @if(old('options') !== null) value="{{ old('options')[$i - 1] }} @else value="{{ $field->options[$i - 1] ?? '' }}" @endif>
                                </div>
                            @endfor
                            @error('options')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('options.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment" value="{{ old('comment', $field->comment) }}">
                            @error('comment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-warning text-warning">Edit Field</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const optionsBlock = document.getElementById('options-block'),
            selectInputEl = document.getElementById('type'),
            typesWithOptions = ['select', 'checkbox'];

        if(selectInputEl && optionsBlock) {
            selectInputEl.addEventListener('change', (event) => optionsBlock.style.display = typesWithOptions.includes(event.currentTarget.value) ? 'block' : 'none');
            document.addEventListener('DOMContentLoaded', () => optionsBlock.style.display = typesWithOptions.includes(selectInputEl.value) ? 'block' : 'none');
        }
    </script>
@endpush
