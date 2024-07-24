<div class="container-fluid p-0">
    <h3 class="mb-5">
        <strong>
            @isset ($user) 
                Update 
            @else 
                Add 
            @endisset a User
        </strong>
    </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form  id="role-form" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                        
                        <!-- if edit form add put method as well -->
                        @if (isset($user))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="firstName">First Name:</label>
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="Enter First Name"
                                    value="{{ old('firstName') ?? $user->first_name ?? '' }}"
                                    required
                                    maxlength="50"
                                />
                                @error('firstName')
                                    <div class="mt-3">
                                        <p class="text-danger fw-bold">{{ $message }}</p>
                                    </div>
                                @endError
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="lastName">Last Name:</label>
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="Enter Last Name"
                                    value="{{ old('lastName') ?? $user->last_name ?? '' }}"
                                    required
                                    maxlength="50"
                                />
                                @error('lastName')
                                    <div class="mt-3">
                                        <p class="text-danger fw-bold">{{ $message }}</p>
                                    </div>
                                @endError
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="email">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email Address"
                                    value="{{ old('email') ?? $user->email ?? '' }}"
                                    required
                                    email
                                />
                                @error('email')
                                    <div class="mt-3">
                                        <p class="text-danger fw-bold">{{ $message }}</p>
                                    </div>
                                @endError
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="role">Role:</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    @if (isset($roles) && count($roles))
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if (old('role') && old('role') == $role->id 
                                                    ||
                                                    isset($user) && $user->role->id == $role->id)

                                                    selected
                                                @endif    
                                            >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('role')
                                    <div class="mt-3">
                                        <p class="text-danger fw-bold">{{ $message }}</p>
                                    </div>
                                @endError
                            </div>
                            <!-- show password field while adding user -->
                            @if (!isset($user))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="password">Password:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" 
                                        placeholder="Enter Password"
                                        required
                                        minlength="8"
                                    />
                                    @error('password')
                                        <div class="mt-3">
                                            <p class="text-danger fw-bold">{{ $message }}</p>
                                        </div>
                                    @endError
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="password_confirmation">Confirm Password:</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                        id="password_confirmation" name="password_confirmation" 
                                        placeholder="Enter Confirm Password"
                                        required
                                        minlength="8"
                                    />
                                    @error('password_confirmation')
                                        <div class="mt-3">
                                            <p class="text-danger fw-bold">{{ $message }}</p>
                                        </div>
                                    @endError
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">
                            @isset ($user) Update @else Add @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>