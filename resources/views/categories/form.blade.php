<div class="container-fluid p-0">
    <h3 class="mb-5">
        <strong>
            @isset ($category) 
                Update 
            @else 
                Add 
            @endisset a Category
        </strong>
    </h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="category-form" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                        
                        <!-- if edit form add put method as well -->
                        @if (isset($category))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name"
                                value="{{ old('name') ?? $category->name ?? '' }}"
                                required
                                maxlength="50"
                            />
                            @error('name')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description:</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter Description"
                                required
                                maxlength="255"
                            >{{ old('description') ?? $category->description ?? '' }}</textarea>
                            @error('description')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">
                            @isset ($category) Update @else Add @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>