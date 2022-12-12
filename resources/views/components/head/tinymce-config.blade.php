<script src="https://cdn.tiny.cloud/1/yzd0owleli15k8t8y0u4391zmyggv6tt068ij79ym1kzrrmw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    // tinymce.init({
    //     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    //     plugins: 'code table lists',
    //     toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    // });
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'code table lists image advcode link textpattern',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link',
        height: window.innerHeight * 0.47,
        relative_urls: false,
        remove_script_host: true,
        document_base_url: '',
        //toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
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
</script>