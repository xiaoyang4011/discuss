$(document).ready(function() {
    var options = {
        beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json'
    };
    $('#image').on('change', function(){
        $('#upload-avatar').html('正在上传...');
        $('#avatar').ajaxForm(options).submit();
    });
});
function showRequest() {
    $("#validation-errors").hide().empty();
    $("#output").css('display','none');
    return true;
}

function showResponse(response)  {
    if(response.success == false)
    {
        var responseErrors = response.errors;
        $.each(responseErrors, function(index, value)
        {
            if (value.length != 0)
            {
                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
            }
        });
        $("#validation-errors").show();
    } else {

        var cropBox = $("#cropbox");
        cropBox.attr('src',response.avatar);
        $('#photo').val(response.avatar);
        $('#upload-avatar').html('更换新头像');
        $('#exampleModal').modal('show');
        cropBox.Jcrop({
            aspectRatio: 1,
            onSelect: updateCoords,
            setSelect: [120,120,10,10]
        });
        $('.jcrop-holder img').attr('src',response.avatar);
    }

    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
    function checkCoords() {
        if (parseInt($('#w').val())) return true;
        alert('请选择图片.');
        return false;
    }
}