@extends('admin.layouts.home')

@section('title')

@endsection

@section('title-page')
    <h1>Judul</h1>
@endsection

@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success mx-4 my-4">
        <p>{{ $message }}</p>
    </div>
    @elseif($message = session::get('deleted'))
    <div class="alert alert-danger mx-4 my-4">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Page</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Caategory</th>
                            <th>Tags</th>
                            <th>Description</th>
                            <th>Writer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach ($posts as $index => $post)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td><img src="{{$post->thumbnail}}" alt="" style="max-height: 100px"></td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td>
                                @foreach ($post->categories as $category)
                                    <li>{{$category->title}}</li>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <li>{{$tag->title}}</li>
                                @endforeach
                            </td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->status}}</td>
                            <td >
                                <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('post_update')
                                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-icon icon-left btn-warning rounded-pill"><i class="fas fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('post_delete')
                                    <button type="submit" class="btn btn-icon icon-left btn-danger rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
