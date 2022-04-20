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

            {{-- <div class="alert alert-info">
              <b>Note!</b> Not all browsers support HTML5 type input.
            </div> --}}
            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title </label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                    @error('title')
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

                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button id="button_article_thumbnail" data-input="input_category_thumbnail" data-preview="holder" class="btn btn-primary" type="button">
                                Browse
                            </button>

                        </div>
                        <input id="input_category_thumbnail" class="form-control" readonly type="text" name="thumbnail">
                    </div>
                    @error('thumbnail')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div id="holder" class=" ml-2 mb-3" style="margin-top:15px;max-height:200px;">

                </div>

                <div class="form-group ">
                    <label >Category</label>
                    <select class="form-control selectpicker" multiple="" name="category[]">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('tag')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label >Tags</label>
                    <select class="form-control selectpicker" multiple="" name="tag[]">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                    @error('tag')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Decription</label>
                    <textarea class="form-control"name="description" rows="3">{{old('description')}}</textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" id="content" name="content" height="1000px">{{old('content')}}</textarea>
                    @error('content')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label >Status</label>
                    <br>
                    <select class="form-control selectric" name="status">
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
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

@push('scripts')
    <script type="text/javascript">
        //imgae flm
        $('#button_article_thumbnail').filemanager('image');
    </script>
@endpush
