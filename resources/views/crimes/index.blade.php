@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Button to Open Modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#crimeModal">
            Record New Crime
        </button>
        <div class="row justify-content-around">
            @foreach ($crimes as $crime)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$crime->crime_title}}</h5>
                        <p class="card-text">{{ $crime->category->category_name }}</p>
                        <p class="card-text">Recorded by Officer {{ $crime->officer->name }}</td></p>
                        @if(Auth::user()->role_id === !3)
                        <p>
                            <form method="POST" action="{{ route('make-case', $crime->id) }}" class="d-inline" onsubmit="return confirmCreateCase()">
                                @csrf
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Case File</button>
                            </form>
                            <form method="POST" action="{{ route('crimes.destroy', $crime->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn text-danger" data-confirm="Are you sure you want to delete this crime?"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </p>
                        @endif
                        <a href="{{ route('crimes.show', $crime->id) }}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Modal for Recording New Crime -->
    <div class="modal fade" id="crimeModal" tabindex="-1" aria-labelledby="crimeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crimeModalLabel">Record New Crime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('crimes.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="crime_title" class="form-label">Crime Title</label>
                            <input type="text" id="crime_title" name="crime_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="crime_description" class="form-label">Crime Description</label>
                            <textarea id="crime_description" name="crime_description" rows="4" class="form-control" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Record Crime</button>
                        </div>
                    </form>
                </div>
            </div>
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

    // Confirmation message for create case
    function confirmCreateCase() {
        return confirm('Create a new case file for this crime?');
    }
</script>
@endsection
