<!--footer sectionen  -->
<footer class="container-fluid   text-center">
<?php
echo "<p class='text-white'> copyright &copy; 2018-".date("Y")." amonecenter.org</p>";
 ?>
<br>

</footer>

<script type="text/javascript">
     // Toggle Sidebar
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</html>
