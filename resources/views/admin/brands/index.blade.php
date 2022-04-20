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
            <a href="{{route('brand.create')}}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Page</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($brands as $index => $brand)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td >
                                <form action="{{ route('brand.destroy',$brand->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-icon icon-left btn-warning rounded-pill"><i class="fas fa-pencil-alt"></i></a>
                                    <button type="submit" class="btn btn-icon icon-left btn-danger rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
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
