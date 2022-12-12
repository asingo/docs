<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'File Manager') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" id="fm-main-block">
        <div id="fm"></div>
      </div>
    </div>
  </div>

  <!-- File manager -->
  <script src="https://cdn.tiny.cloud/1/yzd0owleli15k8t8y0u4391zmyggv6tt068ij79ym1kzrrmw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>

  </script>
  <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // set fm height
      document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');
      document.getElementById('fm').setAttribute('style', 'height:' + window.innerHeight + 'px');

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
</body>

</html>