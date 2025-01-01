@extends('backend.layouts.index')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Collections(Blogs)</h4>
                    <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addCollectionModal">
                        Add Collection
                    </button>
                </div>

                <div class="card-body">
                    <!-- Table to display collections -->
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>S.No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $collection)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $collection->title }}</td>
                                    <td>{{ $collection->category->name ?? 'No Category' }}</td>
                                    <!-- Display associated category -->
                                    <td>
                                        @if ($collection->image)
                                            <img src="{{ asset('backend/img/user/' . $collection->image) }}" alt="Image"
                                                style="width: 50px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit and Delete Buttons -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editCollectionModal{{ $collection->id }}">
                                            Edit
                                        </button>
                                        {{-- delete modal button --}}
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteCollectionModal{{ $collection->id }}">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>



                    </table>
                    {{$collections->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Collection Modal -->
    <div class="modal fade" id="addCollectionModal" tabindex="-1" aria-labelledby="addCollectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCollectionModalLabel">Add Collection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Category Select -->
                        <div class="mb-2">
                            {{-- <label for="category_id" class="form-label">Category</label> --}}
                            <select class="form-select" name="category_id" id="category_id" aria-placeholder="Title" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Title Input -->
                        <div class="mb-2">
                            {{-- <label for="title" class="form-label">Title</label> --}}
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-2">
                            {{-- <label for="description" class="form-label">Description</label> --}}
                            <textarea  style="width: 100%; height: 250px;" class="form-control" id="description" placeholder="Description" name="description"></textarea>
                        </div>

                        <!-- Image Input -->
                        <div class="mb-2">
                            {{-- <label for="image" class="form-label">Image</label> --}}
                            <input type="file" class="form-control" id="image" placeholder="select Image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Collection</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit & Delete Modals for each collection -->
    @foreach ($collections as $collection)
        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCollectionModal{{ $collection->id }}" tabindex="-1"
            aria-labelledby="editCollectionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('blog.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCollectionModalLabel{{ $collection->id }}">Edit
                                collection</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Category Select -->
                            <div class="mb-2">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $collection->category_id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Title Input -->
                            <div class="mb-2">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $collection->title }}" required>
                            </div>

                            <!-- Description Textarea -->
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea style="width: 100%; height: 150px;" class="form-control" id="description" name="description">{{ $collection->description }}</textarea>
                            </div>

                            <!-- Image Input -->
                            <div class="mb-2">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($collection->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('backend/img/user/' . $collection->image) }}"
                                            alt="Current Image" style="width: 50px;">
                                    </div>
                                @endif
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

        <!-- Delete Category Modal -->
        <div class="modal fade" id="deleteCollectionModal{{ $collection->id }}" tabindex="-1"
            aria-labelledby="deleteCollectionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('blog.destroy', $collection->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCollectionModalLabel{{ $collection->id }}">Delete
                                Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the Blog
                                <strong>{{ $collection->title }}</strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
