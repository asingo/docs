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
            <form action="{{ route('actionregister') }}" method="post">
                @csrf

                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" class="form-control primary" required />
                    <label class="form-label" for="email">Email address</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" id="name" name="name" placeholder="Masukkan Nama" class="form-control primary" required />
                    <label class="form-label" for="name">Name</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control" required />
                    <label class="form-label" for="password">Password</label>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="text" name="company" placeholder="Masukkan Situs" class="form-control primary" aria-describedby="siteEx" required />
                            <label class="form-label" for="company">Site Name</label>
                        </div>
                        <div id="siteEx" class="form-text">Write the site name. (e.g. <i>ganeeta.com</i>)</div>
                    </div>
                    <div class="col">
                        <div class="mb-4">
                            <select class="form-select" name="role">
                                <option selected disabled>Role</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Guest">Guest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Email input -->

                <!-- Password input -->

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mt-2">LOGIN</button>
            </form>


        </div>
    </div>
</div>
@endsection