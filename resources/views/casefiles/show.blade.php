@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <p class="mb-4"><strong>Case Number:</strong> {{ $casefile->case_number }}</p>
                <p class="mb-4"><strong>Case Title:</strong> {{ $casefile->case_title }}</p>
                <a href="{{route('crimes.show', ['crime' => $casefile->crime])}}">
                    <p class="mb-4"><strong>Crime:</strong> {{ $casefile->crime->crime_title }}</p>
                </a>
                <p class="mb-4"><strong>Case Officer:</strong> {{ $casefile->crime->officer->name }}</p>
                <p class="mb-4"><strong>Date Created:</strong> {{ $casefile->date_created }}</p>
                <p class="mb-4"><strong>Number of Suspects:</strong> {{ $suspect_count }}</p>
                <p class="mb-4"><strong>Number of Exhibits:</strong> {{ $evidence_count }}</p>
            </div>
        </div>
    </div>
@endsection

