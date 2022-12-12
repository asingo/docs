@extends('../master')
@section('konten')
<div class="m-2">
    <div class="row mb-4">
        <div class="col">
            <h4>{{$title}}</h4>
        </div>
        <div class="col">
            <a href="/home/docs/create?parent={{$folder}}" class="btn btn-primary float-end"><i class="fa fa-plus"></i> Create Docs Here</a>
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
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>@php $i=1; $a=0; @endphp
                <tbody>@foreach ($data as $d)

                    <tr>
                        <td>{{$i++}}</td>
                        <td><a href="#">{{$file[$a++]}}</a></td>

                        <td>
                            <a href="/home/docs/editor?url={{$d}}" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>
                            <a href="javascript:;" class="btn btn-danger" data-type="files" data-mdb-toggle="modal" data-mdb-target="#modalDeleteFile" data-title="{{$d}}" data-id="{{$d}}"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection