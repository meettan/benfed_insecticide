<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Company Payment Pending</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <!-- <h3>
		        <small><a href="<?php echo site_url("compay/company_payment");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                 <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div> 
            </h3> -->
            <!-- <div class="form-group row">
              <form method="POST" action="" >

                        <div class="col-sm-3">
	                    <input type="date" style="width:300px" id=from_date name="from_date" class="form-control"  />
                        </div>

                        <div class="col-sm-3">
                        <input type="date" style="width:250px" id=to_date name="to_date" class="form-control"  />
	                    </div>

                        <div class="col-sm-3">
                        <input type="submit" id= "submit" class="filt" value="Filter" />
                        </div>

               
            </form>
            </div> -->

            <table class="table table-bordered table-hover" id="example">

                <thead>

                    <tr>
                        <th>District</th>
                        <th>Company</th>
                        <!-- <th>NET Amount</th> -->
                    </tr>

                </thead>

                <tbody> 

                    <?php
                        $i=0;
                    if($comp_pay) {
                            foreach($comp_pay as $pay) {
		    ?>

                            <tr>   
                               
                                <td><?php echo $pay->branch_name; ?></td>
                              
                                <td><?php echo $pay->COMP_NAME; ?></td>
                                <!-- <td><?php echo $pay->net_amt; ?></td> -->
                               
			 	                
                            </tr>

                    <?php
                            
                            }

                        }

                        else {

                            echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                        }
                    ?>
                
                </tbody>

                <tfoot>

                    <tr>
                    
                        <!-- <th>Date</th> -->
                        <th>District</th>
                    	<!-- <th>Payment ID</th> -->
                        <th>Company</th>
                        <!-- <th>NET Amount</th> -->
                        <!-- <th>View</th>
                        <th>Delete</th> -->
                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
</script>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {
            
            var id = $(this).attr('id');
            // window.alert("<?php echo $this->session->flashdata('msg'); ?>");
            var result = confirm("Do you really want to delete this record?");
           
            if(result) {

                window.location = "<?php echo site_url('compay/delete_companypay?pay_no="+id+"');?>";

            }
            
        });

    });

</script>

<!-- <script>

    $(document).ready(function() {

    <?php if($this->session->flashdata('msg')){ ?>
	window.alert("<?php echo $this->session->flashdata('msg'); ?>");
    });

    <?php } ?>
</script> -->


