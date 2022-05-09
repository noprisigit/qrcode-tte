$(document).ready(function() {
  $(document).find('.notification').delay(5000).slideUp();
});

function error_submit(err) {
  const json = JSON.parse(err.responseText);
  if (json.errors) {
    $.each(json.errors, function(prefix, value) {
      $(`input#${prefix}`).addClass('is-invalid');
      $(`select#${prefix}`).addClass('is-invalid');
      $(`span#${prefix}`).text(value[0]);
    });
  }
}

function before_submit(form_id) {
  $(document).find(`${form_id} .form-control`).removeClass('is-invalid');
  $(document).find(`${form_id} button[type=submit]`).attr('disabled', true);
  $(document).find(`${form_id} button[type="submit"]`).html('<i class="fas fa-spinner fa-spin"></i>');
}

function complete_submit(form_id, button_text) {
  $(document).find(`${form_id} button[type=submit]`).attr('disabled', false);
  $(document).find(`${form_id} button[type="submit"]`).html(button_text);
}