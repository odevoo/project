


var isAdvancedUpload = function() {
  var div = document.createElement('div');
  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();

$(document).ready(function() {
    
    var $form = $('.box');

    if (isAdvancedUpload) {
        console.log('ok');
    $form.addClass('has-advanced-upload');
    }
    if (isAdvancedUpload) {
        console.log('ok');
  var droppedFiles = false;

  $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
  })
  .on('dragover dragenter', function() {
    $form.addClass('is-dragover');
  })
  .on('dragleave dragend drop', function() {
    $form.removeClass('is-dragover');
  })
  .on('drop', function(e) {
    console.log('drop');
    droppedFiles = e.originalEvent.dataTransfer.files;
    $form.trigger('submit');
  });

  $form.on('submit', function(e) {
    console.log($form);
    var $input    = $form.find('input[type="file"]');
  if ($form.hasClass('is-uploading')) {
    console.log('false');
    return false;
    }
    

  $form.addClass('is-uploading').removeClass('is-error');

  if (isAdvancedUpload) {
    e.preventDefault();
    console.log('ok3');

  var ajaxData = new FormData($form.get(0));

  if (droppedFiles) {
    $.each( droppedFiles, function(i, file) {
      ajaxData.append( $input.attr('name'), file );
    });
  }

  $.ajax({
    url: $form.attr('action'),
    type: $form.attr('method'),
    data: ajaxData,
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    complete: function() {
      $form.removeClass('is-uploading');
    },
    success: function(data) {
      $form.addClass( data.success == true ? 'is-success' : 'is-error' );
      window.scrollTo( 0, 0 );
       location.reload();
      if (!data.success) $errorMsg.text(data.error);
    },
    error: function() {
      // Log the error, show an alert, whatever works for you
    }
  });
  } else {
    // ajax for legacy browsers
  }
});


    }
});
