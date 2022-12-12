@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>Editor - {{$title}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <x-head.tinymce-config />
            <form method="post" action="{{route('saveDocs')}}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$fileName}}">
                </div>
                <input type="hidden" name="url" value="{{$title}}">
                <label for="myeditorinstance" class="form-label">Content</label>
                <textarea id="myeditorinstance" name="content">{{$fileContent}}</textarea>
                <button type="button" onClick="history.back();" class="btn btn-default mt-4"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-save"></i> SAVE</button>
            </form>
        </div>
    </div>
</div>
@endsection