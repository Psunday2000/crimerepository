@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-around">
            @foreach ($evidences as $evidence)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Evidence for {{$evidence->crime->crime_title}}</h5>
                        <p class="card-text">{{ $evidence->evidence_type }}</p>
                        <p class="card-text">{{ $evidence->evidence_name }}</p>
                        <a href="{{ Storage::url($evidence->evidence_content) }}" target="_blank" class="btn btn-primary">View Evidence</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
