@extends('backend.layouts.index')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Contact Information</h4>
                        <!-- Edit Button to open the modal -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editContactModal">Edit</button>
                    </div>
                    <div class="card-body">
                        <!-- Displaying contact details -->
                        <div class="mb-3">
                            <label for="contactEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" value="{{ $contact ? $contact->email:" No email found."}}" disabled>

                        </div>
                        <div class="mb-3">
                            <label for="contactPhoneNo" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="contactPhoneNo" value="{{$contact ? $contact->phone_no:"No phone number found."}}" disabled>

                        </div>
                        <div class="mb-3">
                            <label for="contactDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="contactDescription" rows="3" disabled>{{ $contact ? $contact->description:"no desceiption" }}</textarea>
                        </div>
                    </div>
                </div>
            </div>







        </div>
    </div>

    <!-- Edit Contact Modal -->
<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('contact.update',$contact ? $contact->id : "Null") }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactModalLabel">Edit Contact Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="{{ $contact ? $contact->email:" No email found." }}" required>
                    </div>

                    <!-- Phone Number Input -->
                    <div class="mb-3">
                        <label for="editPhoneNo" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhoneNo" name="phone_no" value="{{ $contact ? $contact->email:" No email found." }}" required>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3">{{ $contact ? $contact->description :"no description" }}</textarea>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
