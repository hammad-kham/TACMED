@extends('backend.layouts.index')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Terms and Conditions</h4>
                        <!-- Edit Button to open the modal -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editTermsModal">Edit</button>
                    </div>
                    <div class="card-body">
                        <!-- Displaying Terms and Conditions details -->
                        <div class="mb-3">
                            <label for="termsTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="termsTitle"
                                value="{{ $data ? $data->title : 'No title available' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="termsDescription" class="form-label">Terms and Conditions</label>
                            <textarea class="form-control" id="termsDescription" style="height: 400px;" disabled>{{ $data ? $data->terms_and_conditions : 'No terms available' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Edit Terms and Conditions Modal -->
        <div class="modal fade" id="editTermsModal" tabindex="-1" aria-labelledby="editTermsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ $data ? route('termsAndCondition.update', $data ? $data->id:"NULL") : route('terms.store') }}" method="POST">
                    @csrf
                    @if ($data)
                        @method('PUT')
                    @endif
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTermsModalLabel">Edit Terms and Conditions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Title Input -->
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="title"
                                    value="{{ $data ? $data->title : '' }}" required>
                            </div>

                            <!-- Terms and Conditions Input -->
                            <div class="mb-3">
                                <label for="editTerms" class="form-label">Terms and Conditions</label>
                                <textarea class="form-control" id="editTerms" name="terms_and_conditions" rows="10" style="height: 280px;"
                                    required>{{ $data ? $data->terms_and_conditions : '' }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
