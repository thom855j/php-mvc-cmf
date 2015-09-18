</div>
</div>
</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


<!-- jQuery -->
<script src="<?php echo $this->project_url; ?>public/assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $this->project_url; ?>public/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- plugins -->
<script src="<?php echo $this->project_url; ?>public/assets/datetimepicker/jquery.datetimepicker.js"></script>
<script src="<?php echo $this->project_url; ?>public/assets/image-picker/image-picker/image-picker.min.js"></script>
<!-- Menu Toggle Script -->
<script>
    $(document).ready(function () {
        //Sidemenu
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        //Datetimepickers
        $('#Start_date').datetimepicker({
            format: 'Y-m-d H:i',
            minDate: 0
        });
        $('#End_date').datetimepicker({
            format: 'Y-m-d H:i',
            minDate: 0
        });

        //Imagepicker
        $("#media-picker").imagepicker();
        
          //Imagepicker
        $("#thumbnail-picker").imagepicker();

    });


</script>


</body></html>
