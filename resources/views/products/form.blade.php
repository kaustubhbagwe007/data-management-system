<div class="container-fluid p-0">
    <h3 class="mb-5">
        <strong>
            @isset ($product) 
                Update 
            @else 
                Add 
            @endisset a Product
        </strong>
    </h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="product-form" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" 
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        
                        <!-- if edit form add put method as well -->
                        @if (isset($product))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name"
                                value="{{ old('name') ?? $product->name ?? '' }}"
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
                            <label class="form-label" for="price">Price:</label>
                            <input type="number" min="1" step=".01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price"
                                value="{{ old('price') ?? $product->price ?? '' }}"
                                required
                                number
                            />
                            @error('price')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description:</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter Description"
                                rows="4"
                                required
                                maxlength="255"
                            >{{ old('description') ?? $product->description ?? '' }}</textarea>
                            @error('description')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="category">Category:</label>
                            <select required class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select Category</option>
                                @if (isset($categories) && count($categories))
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('category') && old('category') == $category->id 
                                                ||
                                                isset($product) && $product->category->id == $category->id)

                                                selected
                                            @endif    
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        @if (isset($product->image))
                            <div class="mb-3">
                                <label class="form-label">Current Product Image:</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src='{{ asset("storage/images/$product->image") }}' class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label" for="image">@if (isset($product)) Update @endif Product Image:</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                id="image" name="image" 
                                accept="image/png, image/jpg, image/jpeg"
                                @if (!isset($product)) required @endif
                            />
                            @error('image')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>

                        <button type="submit" class="btn btn-lg btn-success">
                            @isset ($product) Update @else Add @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>