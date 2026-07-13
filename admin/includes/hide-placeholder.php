<script>
    document.querySelectorAll('.input-group-outline .form-control').forEach(function(input) {

      // Page load pe check
      if (input.value !== '') {
        input.parentElement.classList.add('is-filled');
      }

      input.addEventListener('focus', function() {
        this.parentElement.classList.add('is-focused');
      });

      input.addEventListener('blur', function() {
        if (this.value !== '') {
          this.parentElement.classList.add('is-filled');
        } else {
          this.parentElement.classList.remove('is-filled');
        }
        this.parentElement.classList.remove('is-focused');
      });

    });
  </script>