$(document).ready(function(){
    $('#btn-student').on('click', function() {
        /*$('#form-student').fadeIn();
        $('#form-teacher').fadeOut();*/
        $('#form-student').removeClass('hidden');
        $('#form-teacher').addClass('hidden');
        $('#btn-student').attr("disabled", true);
        $('#btn-teacher').removeAttr("disabled");
    });
    $('#btn-teacher').on('click' ,function() {
        console.log('teacher');
        $('#form-student').addClass('hidden');
        $('#form-teacher').removeClass('hidden');
        $('#btn-teacher').attr("disabled", true);
        $('#btn-student').removeAttr("disabled");
    });
});