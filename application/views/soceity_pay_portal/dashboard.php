<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Society payment list</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>
		        <small></small>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover" id='example'>

                <thead>

                    <tr>
                        <th>Sl.No.</th>
                        <th>District </th>
                        <th>Society Name</th>
                        <th>Payment Date</th>
                        <th>Settlement date</th>
                        <th>Payment Mode</th>
                        <th>Amt</th>
            			<th>Option</th>
                       
                    </tr>

                </thead>

                <tbody> 

                    <?php 
                        $i=0;
                        if($paylist) {
                                foreach($paylist as $value) {
		            ?>

                            <tr>   
                                <td><?php echo ++$i; ?></td>
                              
				                <!-- <td style="">
                                    
                                </td> -->
                                <td><?php echo $value->district_name; ?></td>
                                <td><?php echo get_fertisoc_name($value->soc_id); ?></td>
                                <td><?php echo $value->trans_date; ?></td>
                                <td><?php echo $value->settlement_date; ?></td>
                                <td><?php if($value->payment_mode == 'C'){
                                                echo 'Cash';
                                }else if($value->payment_mode == 'Q'){
                                    echo 'CHEQUE';
                                }else{
                                    echo 'INTERNET BANKING';
                                } ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td>
			 	                <a href="paydetail?order_id=<?php echo $value->order_id;?>"  class='btn btn-primary'
                                         title="Edit">Detail
                                    </a> 
                                </td>
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
                    
                        <th>Sl.No.</th>
                        <th>District </th>
                        <th>Society Name</th>
                        <th>Payment Date</th>
                        <th>Settlement date</th>
                        <th>Payment Mode</th>
                        <th>Amt</th>
            			<th>Option</th>
                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready(function() {

    <?php if($this->session->flashdata('msg')){ ?>
	window.alert("<?php echo $this->session->flashdata('msg'); ?>");
    });

    <?php } ?>

</script>

<link href  = "https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href  = "https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src = "https://code.jquery.com/jquery-3.5.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
</script>