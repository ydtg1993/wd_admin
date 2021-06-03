<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="/bootfile/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
    This must be loaded before fileinput.min.js -->
<script src="/bootfile/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js
   3.3.x versions without popper.min.js. -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. Bootstrap 5.x and 4.x is supported. You can also use the 3.3.x versions. -->
<script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="/bootfile/js/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/themes/fa/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below (replace LANG.js with your locale file) -->
<script src="/bootfile/js/locales/zh.js"></script>
<style>
    .layui-col-md4>.file-input{
        margin: 0 60px 0 0!important;
    }
    label{margin-bottom: 0}
</style>
<script>
    function addFileInput(id,dom,files=[],limit=1,filetype='image') {
        var krajeeGetCount = function(id) {
            var cnt = $('#' + id).fileinput('getFilesCount');
            return cnt === 0 ? 'You have no files remaining.' :
                'You have ' +  cnt + ' file' + (cnt > 1 ? 's' : '') + ' remaining.';
        };

        var initialPreview = [];
        var initialPreviewConfig = [];
        var index = 0;

        if(files instanceof Array) {
            files.forEach(function (file) {
                if (!file) {
                    return;
                }
                initialPreview.push("<img class='kv-preview-data file-preview-image' src='" + '{{config('app.url')}}resources/'+file.value + "'>");
                initialPreviewConfig.push({caption: file.name, width: "120px", key: file.value});
                index++;
            });
        }else {
            var file = files;
            initialPreview.push("<img class='kv-preview-data file-preview-image' src='" + '{{config('app.url')}}resources/'+file.value + "'>");
            initialPreviewConfig.push({caption: file.name, width: "120px", key: file.value});
        }

        var uploadUrl = '{{ route("api.movieFileUpload") }}';
        if(dom == 'map'){
            uploadUrl = '{{ route("api.movieFileBatchUpload") }}';
        }
        var ini = {
            language: 'zh',
            uploadUrl: uploadUrl,
            deleteUrl: '{{ route("api.movieFileRemove") }}',
            showClose: false,
            uploadExtraData:{"_token":"{{ csrf_token() }}","name":dom,"id":id},
            deleteExtraData:{"_token":"{{ csrf_token() }}","name":dom,"id":id},
            showCaption: true,
            dropZoneEnable: true,
            overwriteInitial: false,
            validateInitialCount: true,
            showRemove: false,
            showUpload: false,
            allowedFileExtensions: ["png", "jpg", "jpeg"],
            allowedFileTypes: ["image"],
            uploadAsync: false,
            layoutTemplates: {
                actionUpload: '',
            },
            browseClass: "btn btn-primary",
            maxFileCount: limit,
            autoReplace:false,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
            maxFileSize: 51200,
        };

        if(filetype == 'video'){
            ini.allowedFileExtensions =["mp4", "mpg", "mpeg","avi","rmvb"];
            ini.allowedFileTypes = ["video"];
        }

        var file = $('#' + dom);
        file.fileinput(ini).on('filebeforedelete', function () {
            var aborted = !window.confirm('确定删除该文件么?');
            if (aborted) {
                window.alert('已经删除! ' + krajeeGetCount(dom));
            };
            return aborted;
        }).on('filedeleted', function(event, data) {
            console.log(data)
        }).on("filebatchselected", function(event, files) {
            file.fileinput("upload");
        }).on('fileerror', function(event, data, msg) {
            console.log(data.id);
            console.log(data.index);
            console.log(data.file);
            console.log(data.reader);
            console.log(data.files);
            // 获取信息
            alert(msg);
        });
    }
</script>