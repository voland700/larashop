<script src="{{ asset('assets/admin/js/dropzone.min.js') }}"></script>
<script>
    let myDropzone = new Dropzone("div#dropzone", {
        headers: {'X-CSRF-TOKEN': document.getElementById('CreateForm').querySelector('[name="_token"]').value },
        url: document.getElementById('dropzone').getAttribute('data-url'),
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //uploadMultiple: true,
        addRemoveLinks: true,
        //uploadMultiple: true,
        maxFilesize: 5,
        dictRemoveFile: 'Удалить',
        dictFileTooBig: 'Файл больше 5MB',
        timeout: 5000,
        init: function () {
            this.on("removedfile", function (file) {
                $.post({
                    url: document.getElementById('dropzone').getAttribute('data-remove'),
                    data: {name: file.name, _token: document.getElementById('CreateForm').querySelector('[name="_token"]').value},
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        },
        success: function(file, response)
        {
            //console.log(response);
        },
        error: function(file, response)
        {
            return false;
        }
    });
    Dropzone.autoDiscover = false;
</script>
