<form method="post" action="{{route('saveDocs')}}">
    @csrf
    <textarea id="myeditorinstance" name="asdasda">{{$fileContent}}</textarea>
    <button type="submit" class="btn btn-primary btn-block mt-2"><i class="fa fa-user"></i> Register</button>
</form>