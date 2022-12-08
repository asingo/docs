@extends('../master')
@section('konten')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<div class="mt-2">
    <div class="row mb-4">
        <div class="col">
            <h4>{{$title}}</h4>
        </div>
    </div>

    <div id="fm-main-block">
        <div id="fm"></div>
    </div>


    <!-- File manager -->
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fm-main-block').setAttribute('style', 'height: 80vh');
            document.getElementById('fm').setAttribute('style', 'height:80vh');
            fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                window.opener.fmSetLink(fileUrl);
                window.close();
            });
        });
    </script>
</div>
@endsection