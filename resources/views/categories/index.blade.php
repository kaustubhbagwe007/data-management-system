@extends('layouts.main')

@section('main')

<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-5">
        <h3><strong>Categories</strong></h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="align-middle" data-feather="plus"></i> Add Categories
        </a>
    </div>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories))
                            @foreach ($categories as $key => $role)
                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    {{-- <td>{{ $key + 1 + (($categories->currentPage() - 1) * $categories->perPage()) }}</td> --}}
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $role->id) }}" class="me-3">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>
                                        <a href="javascript::void(0)"
                                            onclick="destroyRecord()"
                                        >
                                            <i class="align-middle" data-feather="trash"></i>
                                        </a>
                                        <form method="POST" action="{{ route('categories.destroy', $role->id) }}" 
                                            id="destroy-record"
                                            data-alert-msg="If you delete this category, all the products related to this category will be deleted. Are you sure you want to delete this category ?"
                                        >
                                            @method("DELETE")
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="3">No Records To Show</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection