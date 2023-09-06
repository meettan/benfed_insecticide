<script>
	
	 $(".sch_cd").select2();   // Code For Select Write Option
</script>



        </section>

        <footer class="sticky-footer" style="background-color: #a0a7ac; text-align: center;">

           <span style="line-height: 5; font-size: 12px;"><strong>Copyright © BENFED. 2020</strong></span>

        </footer>
  
    <?php if($this->session->userdata('loggedin')['active_flag']=='C'){ ?>
    <!-- $(':input[type="submit"]').prop('disabled', true); -->
    <script>

        $('.active_flag_c').attr('disabled','disabled');
    </script>
    <?php } ?>






    
    <!-- <script>
        get_notification();
        function get_notification(){
           
            $.ajax({
						url: "<?=site_url('notification/count')?>",
						method: "POST",
						dataType: "JSON",
						data: {
							action: "",
						},
						success: function (data) {

							$('#notification').html(data);
							
						}
					})
        }


        get_notification_list();
        function get_notification_list(){
            $.ajax({
						url: "<?=site_url('notification/sow10')?>",
						method: "POST",
						dataType: "JSON",
						data: {
							action: "",
						},
						success: function (data) {
							$('#listmotification').html(data);
						}
					})
        }
    </script> -->
    
    </body>

    <?php /*?><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("/assets/js/javascript.js")?>"></script><?php */?>


</html>