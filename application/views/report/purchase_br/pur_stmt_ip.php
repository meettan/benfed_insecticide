<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid #dddddd;
        padding: 6px;
        font-size: 14px;
    }

    th {
        text-align: center;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>


<div class="wraper">

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("fert/rep/purrepbr");?>">

            <div class="form-header">
                <h4>Purchase Date Range & Branch</h4>
            </div>

            <!-- From Date -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">From Date:</label>
                <div class="col-sm-6">
                    <input type="date" name="from_date" class="form-control"
                        value="<?php echo date('Y-m-d');?>" required />
                </div>
            </div>

            <!-- To Date -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">To Date:</label>
                <div class="col-sm-6">
                    <input type="date" name="to_date" class="form-control"
                        value="<?php echo date('Y-m-d');?>" required />
                </div>
            </div>

            <!-- Branch -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Branch:</label>
                <div class="col-sm-6">
                    <select name="br" class="form-control" id="br" required>

                        <option value="0">All Branch</option>

                        <?php foreach($all_branch as $br){ ?>
                            <option value="<?php echo $br->district_code;?>">
                                <?php echo $br->district_name;?>
                            </option>
                        <?php } ?>

                    </select>
                </div>
            </div>

            <!-- Company -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Company:</label>
                <div class="col-sm-6">
                    <select name="comid" class="form-control" id="comid" required>

                        <option value="0">All Company</option>

                        <?php foreach($all_company as $alcp){ ?>
                            <option value="<?php echo $alcp->COMP_ID;?>">
                                <?php echo $alcp->COMP_NAME;?>
                            </option>
                        <?php } ?>

                    </select>
                </div>
            </div>

            <!-- Submit -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-info" value="Submit" />
                </div>
            </div>

        </form>

    </div>

</div>