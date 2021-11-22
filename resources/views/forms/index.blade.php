@extends('index')

@section('document-title', 'Create')
@section('header-form', 'active')

@section('content')
    <div class="col-md-8 offset-md-2 card shadow border-0 p-4">
        @if(count($forms))
            <div class="form-preview">
                <h1 class="text-center border-bottom border-2 pb-2 mb-4">Forms Submitted</h1>
                <div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Created At</th>
                            </thead>
                            <tbody>
                            @foreach($forms as $form)
                                <tr>
                                    <td>
                                        {{ $loop->iteration . '.' }}
                                    </td>
                                    <td>
                                        @foreach($form->fields as $key => $value)
                                            <p class="mb-0">
                                                <strong>
                                                    {{ ucwords($key) }}:
                                                </strong>
                                                @if(gettype($value) === 'array')
                                                    {{ implode(', ', $value) }}
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </p>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $form->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-center">No Form Submitted.</h1>
        @endif
    </div>
@endsection
