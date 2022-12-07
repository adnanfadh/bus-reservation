<script>
    $("#success-alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('#datenow').datepicker({
       format: 'mm-dd-yyyy'
     });

</script>
