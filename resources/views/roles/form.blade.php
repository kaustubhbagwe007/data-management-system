<div class="container-fluid p-0">
    <h3 class="mb-5">
        <strong>
            @isset ($role) 
                Update 
            @else 
                Add 
            @endisset a Role
        </strong>
    </h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="role-form" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
                        
                        <!-- if edit form add put method as well -->
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" 
                                placeholder="Enter Name"
                                value="{{ old('name') ?? $role->name ?? '' }}"
                                required
                            />
                            @error('name')
                                <div class="mt-3">
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                </div>
                            @endError
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">
                            @isset ($role) Update @else Add @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>