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
        @if ($message = Session::get('success'))
        <div class="alert alert-success mx-4 my-4">
            <p>{{ $message }}</p>
        </div>
        @elseif($message = session::get('deleted'))
        <div class="alert alert-danger mx-4 my-4">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body">

            {{-- <div class="alert alert-info">
              <b>Note!</b> Not all browsers support HTML5 type input.
            </div> --}}
            <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label>Title </label>
                    <input type="text" name="title" value="{{$post->title}}" class="form-control">
                    @error('title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Slug (optional) </label>
                    <input type="text" name="slug" value="{{$post->slug}}" class="form-control">
                    @error('slug')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="">Thumbnail Old</label>
                        <br>
                        <img src="{{$post->thumbnail}}" style="max-height:100px;" class="mt-1 mb-3">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Thumbnail(Optional)</label>
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
                    </div>
                </div>


                <div class="form-group ">
                    <label >Category</label>
                    <select class="form-control selectpicker" multiple="" name="category[]">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @foreach ($post->categories as $item)
                               @if ($category->id == $item->id)
                                selected
                               @endif
                            @endforeach >{{$category->title}}</option>
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
                            <option value="{{$tag->id}}" @foreach ($post->tags as $item)
                                @if ($tag->id == $item->id)
                                    selected
                                @endif
                            @endforeach >{{$tag->title}}</option>
                        @endforeach
                    </select>
                    @error('tag')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Decription</label>
                    <textarea class="form-control"name="description" rows="3">{{$post->description}}</textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" id="content" name="content" height="1000px">{{$post->content}}</textarea>
                    @error('content')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label >Status</label>
                    <br>
                    <select class="form-control selectric" name="status">
                        @if ($post->id == "draft")
                        <option value="draft" selected>Draft</option>
                        <option value="publish">Publish</option>
                        @else
                        <option value="draft">Draft</option>
                        <option value="publish" selected>Publish</option>
                        @endif
                    </select>
                </div>



                <div class="form-group text-right">
                    <button class="btn btn-primary mb-2" type="submit">Submit</button>
                    <a href="{{route('post.index')}}" class="btn btn-info  mb-2"> Back</a>
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
