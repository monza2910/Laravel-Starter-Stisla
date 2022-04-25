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
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="document">Photo</label>
                    <div class="needsclick dropzone" id="document-dropzone">

                    </div>
                    @error('photo')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>

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

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10">{{old('description')}}</textarea>
                    @error('description')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Content</label>
                    <textarea name="content" class="form-control" cols="30" rows="10">{{old('content')}}</textarea>
                    @error('content')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" min="0" class="form-control" name="price" value="{{old('price')}}">
                    @error('price')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Qty</label>
                    <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                    @error('qty')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group ">
                    <label >Category</label>
                    <select class="form-control selectpicker" multiple="" name="category[]">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Brand</label>
                    <select name="brand" class="form-control" id="">
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brand')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="draft">draft</option>
                        <option value="active">Active</option>
                    </select>
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-primary mb-2" type="submit">Submit</button>
                    <a href="{{route('product.index')}}" class="btn btn-info  mb-2"> Back</a>
                </div>
            </form>
          </div>
    </div>

</div>
@endsection

@push('script-internal')
   <script>
      var uploadedDocumentMap = {}
      Dropzone.options.documentDropzone = {
         url: '{{ route('product.storeMedia') }}',
         maxFilesize: 2, // MB
         addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png,.gif",
         headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
         success: function(file, response) {
            $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
         },
         removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
               name = file.file_name
            } else {
               name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
         }
      }
   </script>
@endpush
