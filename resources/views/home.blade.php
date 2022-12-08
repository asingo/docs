@extends('master')

@section('konten')
<div class="row d-flex justify-content-center align-items-center" style="height:80vh;">
    <div class="col-8">
        <div class="card" style="border-radius: 8px;">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <h4 class="text-center">Selamat Datang <b>{{Auth::user()->name}}</b>, Anda Login sebagai <b>{{Auth::user()->role}}</b>.</h4>
                        <p class="text-center">Silahkan pilih menu di bawah ini !</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="/home/user">
                            <div class="card justify-content-center align-items-center">
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <i class="fa fa-users" style="font-size: 35px"></i>
                                    </div>
                                    <div class="">
                                        <h5>Lihat Daftar User</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="/home/docsman">
                            <div class="card d-flex justify-content-center align-items-center">
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <i class="fa fa-book" style="font-size: 35px"></i>
                                    </div>
                                    <div class="">
                                        <h5>Lihat Daftar Dokumentasi</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection