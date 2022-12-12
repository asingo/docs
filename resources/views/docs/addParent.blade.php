@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>{{$title}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionAddParent') }}" method="post">
                @csrf
                <div class="form-outline">
                    <input type="text" id="text" name="company" placeholder="Masukkan Situs" class="form-control primary" aria-describedby="siteEx" required />
                    <label class="form-label" for="company">Site Name</label>
                </div>
                <div id="siteEx" class="form-text">Write the site name. (e.g. <i>ganeeta.com</i>)</div>
                <button type="submit" class="btn btn-primary btn-block mt-2">SUBMIT</button>
            </form>


        </div>
    </div>
</div>
@endsection