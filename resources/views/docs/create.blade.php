@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>Create New File on - {{$title}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <x-head.tinymce-config />
            <form method="post" action="{{route('createDocs')}}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="hidden" name="parent" value="{{$title}}">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <label for="myeditorinstance" class="form-label">Content</label>
                <textarea id="myeditorinstance" name="content">{{$template}}</textarea>
                <a href="/home/docsman?go={{$title}}" class="btn btn-default mt-4"><i class="fa fa-chevron-left"></i> Back</a>
                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-save"></i> SAVE</button>
            </form>
        </div>
    </div>
</div>
@endsection