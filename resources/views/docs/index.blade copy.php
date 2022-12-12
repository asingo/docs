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
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('fm-main-block').setAttribute('style', 'height: 80vh');
        //     document.getElementById('fm').setAttribute('style', 'height:80vh');
        //     fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
        //         console.log(fileUrl);
        //         window.opener.fmSetLink(fileUrl);
        //         window.close();
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function() {
            // set fm height
            document.getElementById('fm-main-block').setAttribute('style', 'height:80vh');
            document.getElementById('fm').setAttribute('style', 'height:80vh');
            const FileBrowserDialogue = {
                init: function() {
                    tinymce.init({
                        selector: '#my-textarea',
                        // ...
                        file_picker_callback(callback, value, meta) {
                            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                            tinymce.activeEditor.windowManager.openUrl({
                                url: '/file-manager/tinymce5',
                                title: 'Laravel File manager',
                                width: x * 0.8,
                                height: y * 0.8,
                                onMessage: (api, message) => {
                                    callback(message.content, {
                                        text: message.text
                                    })
                                }
                            })
                        }
                    });

                },
                mySubmit: function(URL) {
                    // pass selected file path to TinyMCE
                    parent.postMessage({
                        mceAction: 'insert',
                        content: URL,
                        text: URL.split('/').pop()
                    })
                    // close popup window
                    parent.postMessage({
                        mceAction: 'close'
                    });
                }
            };

            // Add callback to file manager
            fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                FileBrowserDialogue.mySubmit(fileUrl);
            });
        });
    </script>
</div>
@endsection