<?php if($this->session->flashdata('type')){ ?>
            <div class="row">
			    <div class="col-md-12">
					<div class="alert alert-<?=$this->session->flashdata('type')?>" role="alert">
					<?=$this->session->flashdata('msg')?>
					</div>
				</div>	
			</div>
<?php } ?>