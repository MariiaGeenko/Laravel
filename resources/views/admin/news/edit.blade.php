@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Update news</h1>
        <div class="btn-toolbar mb-2 mb-md-0">



        </div>
    </div>
    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type='danger' :message='$error'></x-alert>
            @endforeach
        @endif
            <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="category_ids">category</label>
                <select class="form-control" name="category_ids[]" id="category_ids" multiple>
                    <option value="0">-- select --</option>
                    @foreach($categories as $category)
                        <option @if(in_array($category->id, $news->categories->pluck('id')->toArray())) selected @endif
                        value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">header</label>
                <input type="text" id="title" name="title" value="{{ $news->title }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="author">author</label>
                <input type="text" id="author" name="author" value="{{ $news->author }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="status">status</label>
                <select class="form-control" name="status" id="status">
                    @foreach($statuses as $status)
                        <option @if($news->status === $status) selected @endif>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">description</label>
                <textarea class="form-control" id="description" name="description">{!! $news->description !!}</textarea>
            </div>

            <br>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
            <br>
            <button class="btn btn-danger">
                <a href="{{ route('admin.news.index') }}" style="text-decoration: none; color: #EEEEEE">Отменить</a>
            </button>
    </div>
@endsection

@push('js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        import {runInContext as CKEDITOR} from "lodash";

        CKEDITOR.replace('description', options);
    </script>
@endpush
