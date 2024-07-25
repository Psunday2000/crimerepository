@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-around">
            <!-- Crime Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Crimes</h5>
                        <p class="card-text">View and manage crimes.</p>
                        <a href="{{ route('crimes.index') }}" class="btn btn-primary">Go to Crimes</a>
                    </div>
                </div>
            </div>

            <!-- Case Files Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Case Files</h5>
                        <p class="card-text">View and manage case files.</p>
                        <a href="{{ route('casefiles.index') }}" class="btn btn-primary">Go to Case Files</a>
                    </div>
                </div>
            </div>

            <!-- Evidences Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Evidences</h5>
                        <p class="card-text">View and manage evidences.</p>
                        <a href="{{ route('evidences.index') }}" class="btn btn-primary">Go to Evidences</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
