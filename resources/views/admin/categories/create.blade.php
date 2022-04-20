@extends('admin.layouts.home')

@section('title')
    {{$title}}
@endsection

@section('title-page')
    <h1>{{$title}}</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name </label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Slug (optional) </label>
                    <input type="text" name="slug" value="{{old('slug')}}" class="form-control">
                    @error('slug')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group text-right">
                    <button class="btn btn-primary mb-2" type="submit">Submit</button>
                    <a href="{{route('category.index')}}" class="btn btn-info  mb-2"> Back</a>
                </div>
            </form>
          </div>
    </div>

</div>
@endsection

