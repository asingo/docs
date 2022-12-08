@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>{{$title}}</h4>
        </div>
        <div class="col">
            <a href="/home/user/add" class="btn btn-primary float-end">Add User</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <table id="user" class="table align-middle mb-1 mt-1 bg-white" style="width:100%">
                <thead class="bg-light">
                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Site</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>@php $i=1 @endphp
                <tbody>@foreach ($data as $d)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$d->name}}</td>
                        <td>{{$d->email}}</td>
                        <td>{{$d->company}}</td>
                        <td>{{$d->role}}</td>
                        <td> <a href="javascript:;" class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#modalDelete" data-title="{{$d->name}}" data-id="{{$d->id}}"><i class="fas fa-trash"></i> Hapus</a>
                            <a href="javascript:;" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#modalEdit" data-title="{{$d->name}}" data-id="{{$d->id}}"><i class="fas fa-pen"></i> Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection