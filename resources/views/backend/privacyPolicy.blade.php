@extends('backend.layouts.index')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Privacy Policy</h4>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPrivacyModal">Edit</button>

                    </div>
                    <div class="card-body">
                        <!-- Displaying Privacy Policy details -->
                        <div class="mb-3">
                            <label for="policyTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="policyTitle"
                                   value="{{ $policy ? $policy->title : 'No policy available' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="policyDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="policyDescription" style="height: 400px;" disabled>{{ $policy ? $policy->privacy_policy : 'No policy description available' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Privacy Policy Modal (Only if $policy exists) -->
@if ($policy)
<div class="modal fade" id="editPrivacyModal" tabindex="-1" aria-labelledby="editPrivacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('privacy.update',$policy ? $policy->id : "Null") }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrivacyModalLabel">Edit Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" value="{{ old('title', $policy ? $policy->title : "NULL") }}" required>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="privacy_policy" rows="3" style="height: 280px;" required>{{ old('privacy_policy', $policy ? $policy->privacy_policy:"NULL") }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
