function dropzone(_num, name){
    var photo_counter = 0;
    Dropzone.autoDiscover = false;

    function addSetPrimaryBtn(){
        $('#dropzone-'+_num+' .dz-image-preview').each(function(index){
            var activeStatus = '';
            var selector = $(this).find('.dz-set-primary').length;

            if(selector == 0){
                if(index == 0) activeStatus = 'active';
                var content = '<a href="javascript:undefined;" class="dz-set-primary ' + activeStatus + '">set primary</a>';
                $(this).append(content);
            }
        })
    }

    $('#dropzone-'+_num).dropzone({
        uploadMultiple: false,
        parallelUploads: 2,
        maxFilesize: 8, // MB
        maxFiles: $(this).attr('max-uploads'),
        previewsContainer: '#dropzonePreview-'+_num,
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        dictFileTooBig: 'Image is bigger than 8MB',

        // The setting up of the dropzone
        init:function() {
            this.on("removedfile", function(file) {
                var upload_type = $('#dropzone-'+_num+' [name="upload_type"]').val();
                $.ajax({
                    type: 'POST',
                    url: upload_type+'/delete',
                    data: {
                        id: file.response.filename
                    },
                    dataType: 'html',
                    success: function(data){
                        var rep = JSON.parse(data);
                        if(rep.code == 200)
                        {
                            photo_counter--;
                            $("#photoCounter-"+_num).text( "(" + photo_counter + ")");
                        }
                    }, 
                    error: function(data, response){
                        console.log(response);
                    }
                });
            });
        },
        error: function(file, response) {
            if($.type(response) === "string"){
                var message = response; //dropzone sends it's own error messages in string
            } else {
                var message = response.message;
            }
            //console.log(file);
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        },
        success: function(file, response) {
            photo_counter++;
            $("#photoCounter-"+_num).text( "(" + photo_counter + ")");
            file.previewElement.classList.add("dz-success");
            file.response = response;

            addSetPrimaryBtn();
        },
    });
}

function setPrimaryTargetId(caller){
    $(caller).delegate('.dz-set-primary', 'click', function(){
        var _this = $(this);
        var upload_type = _this.parents('.dropzone-image').find('[name="upload_type"]').val();
        var target_id = _this.parent().index() + 1;
        
        $(caller + ' .dz-set-primary').removeClass('active');
        _this.toggleClass('active');
        $('input[name="primary_'+upload_type+'_id"]').val(target_id);
    })
} 

 

$(document).ready(function () {
    dropzone(1, 'image');
    dropzone(2, 'carousel'); 

    setPrimaryTargetId('.dropzone-image');
});