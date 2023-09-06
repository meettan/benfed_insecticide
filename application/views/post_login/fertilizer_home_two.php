<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slick/slick-theme.css">

<!-- User Types : Admin ->A User->U Manager->M -->
<!-- Side Menus -->

<!-- //Admin loging in Head Office -->

<?php if($this->session->userdata['loggedin']['branch_id']  == 342 && $this->session->userdata['loggedin']['user_type'] != "A" ) {  ?>

<div class="container-fluid">
  <div class="daseboard_home_new">
    <div class="col-sm-3 float-left">
      <div class="left_bar_new">
        <h2>Quick Links <i class="fa fa-link" aria-hidden="true"></i></h2>
        <ul>
          <li><a href="https://benfed.in/fertilizer/index.php/stock/stock_entry">Purchase</a></li>
          <li><a href="https://benfed.in/fertilizer/index.php/trade/sale">Sale</a></li>
          <li><a href="https://benfed.in/fertilizer/index.php/socpay/society_payment">Customer Payment</a></li>
          <li> <a href="#">Stock Ledger</a></li>
          <li><a href="#">Day Book</a></li>
        </ul>
      </div>
    </div>

    <div class="col-sm-9 float-left rightSideSec">
      <div class="row">
        <div class="threeBoxNewmain">
        <div class="col-sm-6 float-left">
                <div class="threeBoxNewSmall">
                  
                  <div class="threeBoxImg darkBlue"><img src="<?= base_url() ?>assets/images/boxIcon_a.png" alt=""></div>
                  <div class="threeBoxTxt">
                    <h2>Purchase For The Day</h2>
                    <p class="price"><span class="mt">
                        <?php                                                         //Solid

                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y")   //When user in Headoffice
                        {
                          echo $ho_purchase_daysld;
                        } else {                                                  //When user in Branhoffice
                          echo $purchase_day->tot_purchase;
                        }
                        ?>
                        <strong>MT</strong></span>

                      <span class="lit">
                        <?php                                                             //Liquid
                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y") {     //When user in Headoffice

                          echo $ho_purchase_daylqd;
                        } else {                                                        //When user in Branhoffice
                          echo $purchase_day->tot_purchase;
                        }
                        ?>
                        <strong>L</strong>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 float-left">
                <div class="threeBoxNewSmall">
                  <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_b.png" alt=""></div>
                  <div class="threeBoxTxt">
                    <h2>Sale For The Day</h2>
                    <p class="price"><span class="mt"><?php                               //Solid
                                                      if ($this->session->userdata['loggedin']['ho_flag'] == "Y")      //User in HO
                                                      {

                                                        echo $ho_sale_daysld;
                                                      } else {                                                        //In Branch
                                                        echo $sale_day->tot_sale;
                                                      }
                                                      ?><strong>mt</strong></span>
                      <span class="lit"><?php                                          //Liquid
                                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y")       //User in Ho
                                        {
                                          echo $ho_sale_daylqd;
                                        } else {                                                         //user in branch
                                          echo $sale_day->tot_sale;
                                        }
                                        ?> <strong>L</strong></span>
                    </p>
                  </div>
                </div>
              </div>


        </div>

        

        <div class="sectionNew">
          <div class="col-sm-12">
            <h2>District wise Stock</h2>
          </div>

          <div class="col-sm-12">
            <div class="districWisSec">
              <div class="districWisSecLeft">
                <ul>
                  <li><a href="#">Jalpaiguri <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Jhargram <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Kalimpong <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Kolkata <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Malda <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Murshidabad</a></li>
                  <li><a href="#">Nadia <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">North 24 Parganas <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  <li><a href="#">Paschim Medinipur (West Medinipur) <i class="fa fa-arrow-right"
                        aria-hidden="true"></i></a></li>
                  <li><a href="#">Paschim (West) Burdwan (Bardhaman) <i class="fa fa-arrow-right"
                        aria-hidden="true"></i></a></li>
                  <li><a href="#">Purba Burdwan (Bardhaman) <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                  </li>
                </ul>
              </div>
              <div class="districWisSecRightTable" style="width: 70%;">

                <div class="table-responsive">
                  <!--<table class="table table-striped tableCompany">
			  <thead>
				<tr>
				  <th scope="col" style="width:20%">#SL No.</th>
				  <th scope="col" style="width:30%">Within 24 Hours</th>
				  <th scope="col" style="width:30%">After 24 Hours</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td scope="row">1</td>
				  <td>Demo</td>
				  <td>Demo</td>
				</tr>
			  </tbody>
		  
			  <tfoot>
				<tr>
				  <th scope="col">Total</th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				</tr>
			  </tfoot>
		    </table>-->

                  <table class="table table-striped tableCompany">
                    <thead>
                      <tr>
                        <th scope="col">#SL No. </th>
                        <th scope="col">Company name</th>
                        <th scope="col">Solid stock</th>
                        <th scope="col">liquid stock</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> <strong>1</strong></td>
                        <td scope="row">Company name 1</td>
                        <td>650 <strong>mt</strong></td>
                        <td>6500 <strong>L</strong></td>
                      </tr>
                      <tr>
                        <td> <strong>2</strong></td>
                        <td scope="row">Company name 2</td>
                        <td>650 <strong>mt</strong></td>
                        <td>6500 <strong>L</strong></td>
                      </tr>
                      <tr>
                        <td> <strong>3</strong></td>
                        <td scope="row">Company name 3</th>
                        <td>650 <strong>mt</strong></td>
                        <td>6500 <strong>L</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sectionNew">
          <div class="stockPointSecTitle">
            <div class="col-sm-12">
              <h2>Number Of IRN Cancel For The Day</h2>
              <div class="selectBox">
                <select name="district" class="form-control district" id="district">
                  <option value="">Select District</option>
                  <?php
		foreach($distdtls as $dist){
		?>
                  <option value="<?php echo $dist->district_code;?>"><?php echo $dist->district_name;?></option>
                  <?php
		}
		?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="stockPointSec">
              <div class="table-responsive">
                <table class="table table-striped tablestockPoint">
                  <thead>
                    <tr>
                      <th scope="col">#SL No.</th>
                      <th scope="col">Within 24 Hours</th>
                      <th scope="col">After 24 Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="row">1</td>
                      <td>Demo</td>
                      <td>Demo</td>
                    </tr>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th scope="col">Total</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </tfoot>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->


<script>

  var openBtn = document.querySelector('.onClickOpen');
	var accordianConten = document.querySelector('.accordianConten');
	// var accoNotShow = document.querySelector('.accoNotShow');
	// var accoShow = document.querySelector('.accoShow');

	openBtn.onclick = function(){

	if (accordianConten.style.transform === "scaleY(0)") {
		accordianConten.style.transform = "scaleY(1)";
		document.querySelector('.onClickOpen').style.margin = "0 0 18px 0";
		accordianConten.style.height = "auto";
	} else {
		accordianConten.style.transform = "scaleY(0)";
		
		setTimeout(close, 600);
		function close(){
		accordianConten.style.height = "0px";
		document.querySelector('.onClickOpen').style.margin = "0";
		}
	}

	}



function brdaypurchase(br_id){
//   alert(br_id);
$.ajax({
type: "POST",
url: "<?php echo site_url("Fertilizer_Login/f_br_purchase") ?>",
data: {br_id:br_id},

success: function(data){
// alert(JSON.parse(data).tot_pur);
console.log(data);
var data = JSON.parse(data);

$('#dp').html(data.tot_pur);
$('#dpl').html(data.tot_purlqd);
$('#ds').html(data.tot_sale);
$('#dsl').html(data.tot_salelqd);
$('#dpm').html(data.tot_mth_pur);
$('#dpmlqd').html(data.tot_mth_purlqd);
$('#sm').html(data.tot_mth_sal);
$('#smlqd').html(data.tot_mth_salq);
$('#pyr').html(data.tot_puryr);
$('#pyrlq').html(data.tot_puryrlq);
$('#syrlq').html(data.tot_salyrlq);
$('#syr').html(data.tot_salyr);
$('#recvdy').html(data.tot_recvday);
$('#recvmnth').html(data.tot_recvmnth);
$('#recvyr').html(data.tot_recvyr);
}
// error: function() { alert("Error posting feed."); }
});
}
</script>

<script>

$(document).ready(function(){

var i = 0;

$('#district').change(function(){

$.get( 

'<?php echo site_url("Fertilizer_Login/f_get_stkpnt");?>',

{ 

district: $(this).val()

}

).done(function(data){

var string = '';
var tot_sld = 0.00;
var tot_lqd = 0.00;
$.each(JSON.parse(data), function( index, value ) {

string += '<tr><td scope="row" name="soc">'+value.soc_name+'</td><td name="soc">'+value.qty_sld+'<strong>mt</strong></td><td name="soc">'+value.qty_lqd+' <strong>L</strong></td></tr>';
tot_sld +=parseFloat(value.qty_sld);
tot_lqd +=parseFloat(value.qty_lqd);
});
tot_sld=parseFloat(tot_sld).toFixed(3)
tot_lqd=parseFloat(tot_lqd).toFixed(3)
$('#soc').html(string);
$('#f_totsld').html(tot_sld);
$('#f_totlqd').html(tot_lqd);

});


});

});
</script>
<script>
<?php 
$label = '' ;
$qty   = '' ;
foreach($distwisesale as $key) {
$label .=  '"'.$key->district_name.'",';
$qty   .=   ($key->qty).',';

}

?>
window.onload = function () {

var data = {
labels: [<?php echo rtrim($label,",");?>],
datasets:[{
label: '# of Votes',
data: [<?php echo rtrim($qty,",");?>],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)',
'rgba(245, 86, 82, 0.2)',
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)',
'rgba(245, 86, 82, 1)',
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
}

    var barChartId = document.getElementById("barChart");
    if(barChartId){
		var ctxB = document.getElementById("barChart").getContext('2d');
		var myBarChart = new Chart(ctxB, {
		type: 'bar',
		data: data,
		options: {
		"hover": {
		"animationDuration": 0
		},
		"animation": {
		"duration": 1,
		"onComplete": function() {
		var chartInstance = this.chart,
		ctx = chartInstance.ctx;
		ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
		ctx.textAlign = 'center';
		ctx.textBaseline = 'bottom';

		this.data.datasets.forEach(function(dataset, i) {
		var meta = chartInstance.controller.getDatasetMeta(i);
		meta.data.forEach(function(bar, index) {
		var data = dataset.data[index];
		ctx.fillText(data, bar._model.x, bar._model.y - 5);
		});
		});
		}
		},
		legend: {"display": false},
		tooltips: {"enabled": false},
		scales:{
		yAxes: [{
		scaleLabel: {
		display: true,
		labelString: 'Unit in MT'
		}
		// ,
		// ticks: {
		// min: 0, // minimum value
		// max: 1600, // maximum value
		// stepSize: 200
		// }
		}]
		}   
		}


		});
    }
	
	<?php 
$label = '' ;
$qty   = '' ;
foreach($distwisesaleltr as $key) {
$label .=  '"'.$key->district_name.'",';
$qty   .=   ($key->qty).',';

}

?>
	var data = {
labels: [<?php echo rtrim($label,",");?>],
datasets:[{
label: '# of Votes',
data: [<?php echo rtrim($qty,",");?>],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)',
'rgba(245, 86, 82, 0.2)',
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)',
'rgba(245, 86, 82, 1)',
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
}
	
	var barChartId = document.getElementById("barChartl");
    if(barChartId){
		var ctxB = document.getElementById("barChartl").getContext('2d');
		var myBarChart = new Chart(ctxB, {
		type: 'bar',
		data: data,
		options: {
		"hover": {
		"animationDuration": 0
		},
		"animation": {
		"duration": 1,
		"onComplete": function() {
		var chartInstance = this.chart,
		ctx = chartInstance.ctx;
		ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
		ctx.textAlign = 'center';
		ctx.textBaseline = 'bottom';

		this.data.datasets.forEach(function(dataset, i) {
		var meta = chartInstance.controller.getDatasetMeta(i);
		meta.data.forEach(function(bar, index) {
		var data = dataset.data[index];
		ctx.fillText(data, bar._model.x, bar._model.y - 5);
		});
		});
		}
		},
		legend: {"display": false},
		tooltips: {"enabled": false},
		scales:{
		yAxes: [{
		scaleLabel: {
		display: true,
		labelString: 'Unit in LTR'
		}
		// ,
		// ticks: {
		// min: 0, // minimum value
		// max: 1600, // maximum value
		// stepSize: 200
		// }
		}]
		}   
		}

		});
    }

}
<?php 
$label = '' ;
$qty   = '' ;
foreach($distamt as $key) {
$label .=  '"'.$key->district_name.'",';
$qty   .=   ($key->paid_amt).',';

}

?>
var data = {
labels: [<?php echo rtrim($label,",");?>],
datasets:[{
label: '# of Votes',
data: [<?php echo rtrim($qty,",");?>],
backgroundColor: [
'rgba(255, 99, 132, 0.8)',
'rgba(54, 162, 235, 0.8)',
'rgba(255, 206, 86, 0.8)',
'rgba(75, 192, 192, 0.8)',
'rgba(153, 102, 255, 0.8)',
'rgba(255, 159, 64, 0.8)',
'rgba(245, 86, 82, 0.8)',
'rgba(255, 99, 132, 0.8)',
'rgba(54, 162, 235, 0.8)',
'rgba(255, 206, 86, 0.8)',
'rgba(75, 192, 192, 0.8)',
'rgba(153, 102, 255, 0.8)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)',
'rgba(245, 86, 82, 1)',
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
}

var barChartBottomId = document.getElementById("barChartBottom");
if(barChartBottomId){
var ctxC = document.getElementById("barChartBottom").getContext('2d');

var myBarChartBot = new Chart(ctxC, {
type: 'bar',
data: data,
options: {
"hover": {
"animationDuration": 0
},
"animation": {
"duration": 1,
"onComplete": function() {
var chartInstance = this.chart,
ctx = chartInstance.ctx;
ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
ctx.textAlign = 'center';
ctx.textBaseline = 'bottom';

this.data.datasets.forEach(function(dataset, i) {
var meta = chartInstance.controller.getDatasetMeta(i);
meta.data.forEach(function(bar, index) {
var data = dataset.data[index];
ctx.fillText(data, bar._model.x, bar._model.y - 5);
});
});
}
},
legend: {"display": false},
tooltips: {"enabled": false},
scales:{
yAxes: [{
scaleLabel: {
display: true,
labelString: 'Amount in crores'
}
}]
}   
}

});
}
$('#toggleDiv').hide(); 
function expandDiv(){
if($('#toggleDiv').is(':visible')){
$('#toggleDiv').slideUp("slow");
}
else{
$('#toggleDiv').slideDown("slow");
}
}
</script>
<script src="<?php //echo base_url("/assets/js/custom.js")?>" ></script> 
<?php /*?><script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/slick/slick.js" type="text/javascript" charset="utf-8"></script><?php */?>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

<script>
$(".sliderBotSlickSlider").slick({
        dots: false,
        vertical: false,
        centerMode: false,
		    autoplay: true,
        slidesToShow:1,
		    speed: 500,
		    arrows : true,
        slidesToScroll: 1
});
</script>