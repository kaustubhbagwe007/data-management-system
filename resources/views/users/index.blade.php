@extends('layouts.main')

@section('main')

<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-5">
        <h3><strong>Users</strong></h3>
        <div>
            @can('viewAny', App\Models\User::class)

                <a href="{{ route('users.export') }}" class="btn btn-primary me-3">
                    <i class="align-middle" data-feather="download"></i> Download Users
                </a>
            
            @endCan

            @can('create', App\Models\User::class)

                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="align-middle" data-feather="plus"></i> Add Users
                </a>

            @endCan

        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            @can('update', App\Models\User::class)

                                <th>Action</th>

                            @endCan
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users))
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $key }}</td>
                                    {{-- <td>{{ $key + 1 + (($users->currentPage() - 1) * $users->perPage()) }}</td> --}}
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    
                                    @can('update', App\Models\User::class)

                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="me-3">
                                                <i class="align-middle" data-feather="edit"></i>
                                            </a>
                                            <a href="javascript::void(0)"
                                                onclick="destroyRecord()"
                                            >
                                                <i class="align-middle" data-feather="trash"></i>
                                            </a>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" id="destroy-record">
                                                @method("DELETE")
                                                @csrf
                                            </form>
                                        </td>

                                    @endCan
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">No Records To Show</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection