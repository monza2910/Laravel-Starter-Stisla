@extends('admin.layouts.home')

@section('title')
    {{$title}}
@endsection

@section('title-page')
    <h4>{{$title}}</h4>
@endsection

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('product.create')}}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Page</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Product Views</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                @foreach ($product->categories as $category)
                                <li>{{$category->name}}</li>
                                @endforeach
                            </td>
                            <td>{{$product->brands->name}}</td>
                            <td>{{$product->qty}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->view_count}}</td>
                            <td >
                                <form action="{{ route('product.kill',$product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('product.restore',$product->id)}}" class="btn btn-icon icon-left btn-warning rounded-pill"><i class="fas fa-undo"></i></a>
                                    <button type="submit" class="btn btn-icon icon-left btn-danger rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data ini?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
