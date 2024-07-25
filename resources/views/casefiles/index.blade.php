@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Case Files Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Case Title</th>
                        <th>Case Number</th>
                        <th>Crime</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($casefiles as $casefile)
                    <tr>
                        <td>{{ $casefile->case_title }}</td>
                        <td>{{ $casefile->case_number }}</td>
                        <td><a href="{{ route('crimes.show', ['crime' => $casefile->crime]) }}">
                            {{ $casefile->crime->crime_title }}
                        </a></td>
                        <td>
                            <a href="{{ route('casefiles.show', $casefile->id) }}" class="text-primary"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                            @if(Auth::user()->role_id === !3)
                            <form method="POST" action="{{ route('casefiles.destroy', $casefile->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn text-danger" data-confirm="Are you sure you want to delete this crime?"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Confirmation message for delete
        document.querySelectorAll('[data-confirm]').forEach(button => {
            button.addEventListener('click', (e) => {
                if (!confirm(button.getAttribute('data-confirm'))) {
                    e.preventDefault();
                } else {
                    button.closest('form').submit();
                }
            });
        });
    </script>
@endsection

