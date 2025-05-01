document.addEventListener('DOMContentLoaded', function() {
  let forms = document.querySelectorAll('.career-filter-form');

  forms.forEach(function(form) {
    let selects = form.querySelectorAll('.auto-submit');

    selects.forEach(function(select) {
      select.addEventListener('change', function() {
        form.submit();
      });
    });
  });
});