@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>{{$title}}</h4>
        </div>
        <div class="col">
            <a href="/home/docs/add/parent" class="btn btn-primary float-end"><i class="fa fa-plus"></i> Create Parent Docs</a>
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
                        <th>Folder Name</th>

                        <th>Action</th>
                    </tr>
                </thead>@php $i=1 @endphp
                <tbody>@foreach ($data as $d)

                    <tr>
                        <td>{{$i++}}</td>
                        <td><a href="?go={{$d->folder}}">{{$d->folder}}</a></td>

                        <td> <a href="javascript:;" class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#modalDelete" data-type="parent" data-title="{{$d->folder}}" data-id="{{$d->id}}"><i class="fas fa-trash"></i> Hapus</a>
                            <a href="javascript:;" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#modalEditParent" data-title="{{$d->folder}}" data-id="{{$d->id}}"><i class="fas fa-pen"></i> Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection