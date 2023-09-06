<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slick/slick-theme.css">

<!-- User Types : Admin ->A User->U Manager->M -->
<!-- Side Menus -->

<!-- //User loging in Branch Office -->

<?php if($this->session->userdata['loggedin']['ho_flag']  == 'N' && $this->session->userdata['loggedin']['user_type'] == 'U' ){ ?>
<div class="container-fluid" style="padding-top:25px; padding-bottom:25px;">
  <div class="daseboard_home_new">

    <div class="col-sm-3 float-left">
      <div class="left_bar_new">
        <h2>Quick Links <i class="fa fa-link" aria-hidden="true"></i></h2>
        <ul>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/adv/advancefilter">Advance</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/adv/advancefwd">Advance Forward</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/stock/stock_entry">Purchase</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/trade/sale">Sale</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/drcrnote/dr_note">Credit Note</a></li>
		  <li><a href="https://benfed.in/benfed_fertilizer/index.php/socpay/society_payment">Receive Payment</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/socpay/soc_payment_fwd">Forward Payment</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/stkStmt">Consolidated Stock</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/stkSprod">Productwise Stock</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/purrep">Purchase Ledger</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/salerep">Sale Ledger</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/cust_payblepaid">Due Register</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/soc_ledger">Society Ledger</a></li>
          <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/overdue_list">Overdue List</a></li>
        </ul>
      </div>
    </div>

    <div class="col-sm-9 float-left rightSideSec">
      <div class="row">
	  <div class="threeBoxNewmain">
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg redCol"><img src="<?= base_url() ?>assets/images/boxIcon_d.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Opening</h2>
                   <p class="price"><span class="mt"><?= $openingS ?><strong> MT</strong></span>
                    <span class="lit"><strong> </strong><?= $openingL ?><strong> LTR</strong></span></p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg darkBlue"><img src="<?= base_url() ?>assets/images/boxIcon_a.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Purchase For The Day</h2>
                  <p class="price"><span class="mt"><?= round($totsolidpur, 3); ?><strong> mt</strong></span>
                    <span class="lit"><strong> </strong><?= round($totliquidpur, 3); ?><strong> LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_b.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Sale For The Day</h2>
                  <p class="price"><span class="mt"><?= round($brsalesolidtoday, 3); ?><strong> MT</strong></span>
                    <span class="lit"><strong> </strong><?= round($brsaleliquidtoday, 3); ?><strong>
                        LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="threeBoxNewmain">
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg lightBlue"><img src="<?= base_url() ?>assets/images/boxIcon_e.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Closing</h2>
                  <p class="price"><span class="mt"><?=$closingS?><strong>
                        MT</strong></span>
                    <span class="lit"><strong>
                      </strong><?= $closingL ?><strong> LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_collec.png" alt="">
                </div>
                <div class="threeBoxTxt">
                  <h2>Today's Collection</h2>
                  <p class="price">
                    <span class="lit"><strong> </strong><i class="fa fa-inr" aria-hidden="true"></i><?= round($todaycollection->tot_recvamt,3) ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg redCol"><img src="<?= base_url() ?>assets/images/boxIcon_inv.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>No.of Invoices </h2>
                  <p class="price"><span class="mt"><?= $b2b->cnt ?><strong> B2B</strong></span>
                    <span class="lit"><strong> </strong><?= $b2c->cnt ?><strong> B2C</strong></span>
                  </p>
                </div>
              </div>
            </div>

          </div>

        <div class="col-sm-12">
          <section class="sliderBotSlickSlider">
            <section class="sliderBot">
              <section class="bannerTxt"><img src="<?=base_url()?>assets/images/banner1.jpg" alt=""></section>
            </section>
            <section class="sliderBot">
              <section class="bannerTxt"><img src="<?=base_url()?>assets/images/banner2.jpg" alt=""></section>
            </section>
            <section class="sliderBot">
              <section class="bannerTxt"><img src="<?=base_url()?>assets/images/banner3.jpg" alt=""></section>
            </section>
          </section>
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