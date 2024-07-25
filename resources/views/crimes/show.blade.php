@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <p class="mb-4"><strong>Title:</strong> {{ $crime->crime_title }}</p>
                <p class="mb-4"><strong>Description:</strong> {{ $crime->crime_description }}</p>
                <p class="mb-4"><strong>Category:</strong> {{ $crime->category->category_name }}</p>
                <p class="mb-4"><strong>Officer:</strong> {{ $crime->officer->name }}</p>
                <p class="mb-4"><strong>Date Created:</strong> {{ $crime->date_created }}</p>

                <!-- Suspects Table -->
                <h3 class="font-weight-bold mb-3">Suspects</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mugshot</th>
                            <th>Height</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            @if(Auth::user()->role_id === !3)<th>Actions</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crime->suspects as $suspect)
                            <tr>
                                <td>{{ $suspect->suspect_name }}</td>
                                <td>
                                    <img src="{{ Storage::url($suspect->mugshot) }}" alt="Mugshot" width="115" height="150">
                                </td>
                                <td>{{ $suspect->height}} ft</td>
                                <td>{{ $suspect->address }}</td>
                                <td>{{ $suspect->date_of_birth }}</td>
                                @if(Auth::user()->role_id === !3)
                                <td>
                                    <form action="{{ route('suspects.destroy', $suspect->id) }}" method="POST" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                    </form>
                                </td>
                                @endif                                        
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Add Suspect Button -->
                @if(Auth::user()->role_id == 2)
                    <button class="btn btn-primary mt-4" onclick="openSuspectModal()">Add Suspect</button>
                @endif

                <!-- Evidence Table -->
                <h3 class="font-weight-bold mt-5 mb-3">Evidence</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Content</th>
                            <th>Date Collected</th>
                            @if(Auth::user()->role_id === !3)<th>Actions</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crime->evidences as $evidence)
                            <tr>
                                <td>{{ $evidence->evidence_type }}</td>
                                <td>{{ $evidence->evidence_name }}</td>
                                <td>
                                    <a href="{{ Storage::url($evidence->evidence_content) }}" target="_blank" class="text-primary">View Evidence</a>
                                </td>                                        
                                <td>{{ $evidence->date_collected }}</td>
                                @if(Auth::user()->role_id === !3)
                                <td>
                                    <form action="{{ route('evidences.destroy', $evidence->id) }}" method="POST" onsubmit="return confirmEvidenceDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Add Evidence Button -->
                @if(Auth::user()->role_id == 2)
                    <button class="btn btn-primary mt-4" onclick="openEvidenceModal()">Add Evidence</button>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Suspect Modal -->
    <div id="suspectModal" class="modal fade" tabindex="-1" aria-labelledby="suspectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suspectModalLabel">Add Suspect</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('suspects.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="crime_id" value="{{ $crime->id }}">

                        <div class="mb-3">
                            <label for="suspect_name" class="form-label">Name</label>
                            <input id="suspect_name" class="form-control" type="text" name="suspect_name" value="{{ old('suspect_name') }}" required>
                            @error('suspect_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mugshot" class="form-label">Mugshot</label>
                            <input id="mugshot" class="form-control" type="file" name="mugshot" required>
                            @error('mugshot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input id="height" class="form-control" type="text" name="height" value="{{ old('height') }}" required>
                            @error('height')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" class="form-control" type="text" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Suspect</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Evidence Modal -->
    <div id="evidenceModal" class="modal fade" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evidenceModalLabel">Add Evidence</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('evidences.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="crime_id" value="{{ $crime->id }}">

                        <div class="mb-3">
                            <label for="evidence_type" class="form-label">Type</label>
                            <input id="evidence_type" class="form-control" type="text" name="evidence_type" value="{{ old('evidence_type') }}" required>
                            @error('evidence_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="evidence_name" class="form-label">Name</label>
                            <input id="evidence_name" class="form-control" type="text" name="evidence_name" value="{{ old('evidence_name') }}" required>
                            @error('evidence_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="evidence_content" class="form-label">Content</label>
                            <input id="evidence_content" class="form-control" type="file" name="evidence_content" required>
                            @error('evidence_content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Evidence</button>

                        <!-- General error message -->
                        @if ($errors->has('general'))
                            <div class="text-danger mt-3">
                                {{ $errors->first('general') }}
                            </div>
                        @endif
                    </form>                                                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <script>
        function openSuspectModal() {
            var myModal = new bootstrap.Modal(document.getElementById('suspectModal'));
            myModal.show();
        }

        function openEvidenceModal() {
            var myModal = new bootstrap.Modal(document.getElementById('evidenceModal'));
            myModal.show();
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this suspect?');
        }

        function confirmEvidenceDelete() {
            return confirm('Are you sure you want to delete this evidence?');
        }
    </script>
@endsection