@extends('index')

@section('document-title', 'Create')
@section('header-fields', 'active')

@section('content')
    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3 card shadow border-0 p-4">
        <div class="add-fields-block">
            <h1 class="text-center border-bottom border-2 pb-2 mb-4">Create Field</h1>
            <form method="post" action="{{ route('fields.store') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}" required>
                            @error('label')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name (alpha-numeric only)</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                @foreach(config('settings.input_types') as $type)
                                    <option value="{{ $type }}" @if(old('type') === $type) selected @endif>{{ ucwords($type) }}</option>
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
                                    <input type="text" class="form-control" id="option-{{ $i }}" name="options[]" @if(old('options') !== null) value="{{ old('options')[$i - 1] }} @endisset">
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
                            <input type="text" class="form-control" id="comment" name="comment" value="{{ old('comment') }}">
                            @error('comment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary">Add Field</button>
                </div>
            </form>
        </div>
    </div>

    @if(count($fields))
        <div class="col-md-10 offset-md-1 card shadow border-0 p-4">
            <div class="form-preview">
                <h1 class="text-center border-bottom border-2 pb-2 mb-4">Form Fields</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Label</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Options</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fields as $field)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $field->label }}
                                </td>
                                <td>
                                    {{ $field->name }}
                                </td>
                                <td>
                                    {{ ucwords($field->type) }}
                                </td>
                                <td>
                                    {{ count($field->options) ? implode(', ', $field->options) : 'N/A' }}
                                </td>
                                <td>
                                    {{ $field->comment ?? 'N/A' }}
                                </td>
                                <td>
                                    <form action="{{ route('fields.destroy', $field->id) }}" method="post" class="d-flex align-items-center justify-content-start">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('fields.edit', $field->id) }}" class="btn btn-warning btn-sm text-white me-2">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
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
