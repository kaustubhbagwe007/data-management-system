@extends('layouts.main')

@section('main')

    <div class="container-fluid p-0">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h3><strong>Products</strong></h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Add Products
            </a>
        </div>

        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products))
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $products->firstItem() + $key }}</td>
                                        {{-- <td>{{ $key + 1 + (($products->currentPage() - 1) * $products->perPage()) }}</td> --}}
                                        <td>
                                            <a href="#" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#category-detail-modal"
                                                onclick="populateCategoryModal('{{ $product->category->name }}', '{{ $product->category->description }}')"
                                            >
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src='{{ asset("/storage/images/{$product->image}") }}'
                                                    class="avatar rounded img-fluid me-2" />
                                                <span>
                                                    {{ $product->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>₹{{ $product->price }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="me-3">
                                                <i class="align-middle" data-feather="edit"></i>
                                            </a>
                                            <a href="javascript::void(0)" onclick="destroyRecord()">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </a>
                                            <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                                id="destroy-record">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="category-detail-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Category Details</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5>
                            <span class="fw-bold">Name: </span> <span id="category-name"></span>
                        </h5>
                        <h5>
                            <span class="fw-bold">Description: </span> <span id="category-description"></span>
                        </h5>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
