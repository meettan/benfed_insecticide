    <div class="wraper">  
        <div class="col-md-3"></div>

        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form" action="<?php echo site_url("key/editcompany");?>" >

                <div class="form-header">
                
                    <h4>Edit Company</h4>
                
                </div>

                <div class="form-group row">

                    <label for="comp_id" class="col-sm-2 col-form-label">Company ID:</label>

                    <div class="col-sm-10">

                        <input type="text" name="comp_id" class="form-control required"  
                        value = "<?php echo $schdtls->comp_id; ?>" readonly
                        />
                    </div>

                </div>


                <div class="form-group row">

                    <label for="comp_name" class="col-sm-2 col-form-label">Name:</label>

                    <div class="col-sm-10">

                        <input type="text" name="comp_name" class="form-control required"  
                            value = "<?php echo $schdtls->comp_name; ?>" 
                        />
		            </div>

	      	    </div>

                <div class="form-group row">

                    <label for="short_name" class="col-sm-2 col-form-label">Abbreivited Name:</label>

                    <div class="col-sm-10">

                        <input type="text" name="short_name" class="form-control required"  
                            value = "<?php echo $schdtls->short_name; ?>" 
                        />
                    </div>

                </div>
                          
                <div class="form-group row">

                    <label for="comp_add" class="col-sm-2 col-form-label">Address:</label>

                    <div class="col-sm-10">

                        <textarea name="comp_add" class="form-control required"><?php echo $schdtls->comp_add; ?></textarea >
                    </div>

                </div>

                <div class="form-group row">

                    <label for="comp_email_id" class="col-sm-2 col-form-label">email:</label>

                    <div class="col-sm-10">

                        <input type="email" name="comp_email_id" class="form-control required"  
                            value = "<?php echo $schdtls->comp_email_id; ?>" 
                        />
                    </div>

                </div>

                <div class="form-group row">

                    <label for="comp_pn_no" class="col-sm-2 col-form-label">Phone No:</label>

                    <div class="col-sm-10">

                        <input type="text" name="comp_pn_no" class="form-control required"  
                            value = "<?php echo $schdtls->comp_pn_no; ?>" 
                        />
                    </div>

                </div>

                <div class="form-group row">

                    <label for="gst_no" class="col-sm-2 col-form-label">GSTIN NO:</label>

                    <div class="col-sm-4">

                        <input type="text" style="width:170px;" name="gst_no" class="form-control required"  
                            value = "<?php echo $schdtls->gst_no; ?>" 
                        />
                    </div>

                    <label for="cin" class="col-sm-2 col-form-label"> CIN:</label>

                    <div class="col-sm-4">

                        <input type="text" style="width:170px;" name="cin" class="form-control required"  
                            value = "<?php echo $schdtls->cin; ?>" 
                        />
                    </div>

                </div>
                  

                <div class="form-group row">

                    <label for="mfms" class="col-sm-2 col-form-label"> mFMS ID:</label>

                    <div class="col-sm-4">

                        <input type="text" style="width:170px;" name="mfms" class="form-control required"  
                            value = "<?php echo $schdtls->mfms; ?>" 
                        />
                    </div>

                    <label for="pan_no" class="col-sm-2 col-form-label">PAN:</label>

                    <div class="col-sm-4">

                        <input type="text" style="width:170px;" name="pan_no" class="form-control required"  
                            value = "<?php echo $schdtls->pan_no; ?>" 
                        />
                    </div>
                </div>
                <div class="form-group row">

                    <label for="bank_name" class="col-sm-2 col-form-label">Bank:</label>

                    <div class="col-sm-4">

                        <input type="text"  name="bank_name" class="form-control required"  
                            value = "<?php echo $schdtls->bank_name; ?>" 
                        />
                    </div>

                    <label for="bnk_branch_name" class="col-sm-2 col-form-label">Branch:</label>

                    <div class="col-sm-4">

                        <input type="text"  name="bnk_branch_name" class="form-control required"  
                            value = "<?php echo $schdtls->bnk_branch_name; ?>" 
                        />
                    </div>
                </div>
                <div class="form-group row">

                    <label for="ac_no" class="col-sm-2 col-form-label">Ac. No.:</label>

                    <div class="col-sm-4">

                        <input type="text"  name="ac_no" class="form-control required"  
                            value = "<?php echo $schdtls->ac_no; ?>" 
                        />
                    </div>

                    <label for="ifsc" class="col-sm-2 col-form-label">IFSC:</label>
                    <div class="col-sm-4">
                        <input type="text"  name="ifsc" class="form-control required"  
                            value = "<?php echo $schdtls->ifsc; ?>" 
                        />
                    </div>
                </div>
                       
                        			
                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info active_flag_c" value="Save" />

                    </div>

                </div>
                         
            </form>

        </div>

    </div>

    


