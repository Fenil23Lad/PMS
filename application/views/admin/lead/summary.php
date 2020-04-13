<div class="pageheader">
	<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-calendar-o" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Manage Lead</li>
            </ul>
            <h4>Manage Lead</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==================PAGE CONTENT START=====================================--->
<div class="contentpanel">
    <div class="panel panel-primary">
        <div class="panel-heading" style="padding:10px">
            <div class="panel-btns" style="display: none;">
                <a href="#" class="panel-minimize tooltips" data-toggle="tooltip" 
                title="" data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                <a href="#" class="panel-close tooltips" data-toggle="tooltip" 
                title="" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
            </div><!-- panel-btns -->
            <h3 class="panel-title">MONTHLY LEAD ANALYSIS</h3>
        </div>
        <div class="panel-body">
        <form action="<?=base_url('admin/lead/summary');?>" method="post">
            <div class="row">
                <div class="col-md-5">
                    <p>The following line chart describes the details of no. of generated lead by perticular person in the selected month.</p>
                </div>
                <div class="col-md-2">
                	<input type="text" id="date" name="filter_month" 
                    value="<?=$filter_month?>" class="form-control">
                </div>
                <div class="col-md-2">
                	<input type="submit" class="btn btn-primary btn-metro mr10" value="Filter" />
                </div>
            </div><!-- row --> 
            <div class="row">
                <div class="col-md-12">
                    <div id="line-chart" class="height300"></div>
                </div>
            </div><!-- row -->
        </form> 
        </div><!-- panel-body -->
    </div>
</div>
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>

<script src="<?=base_url('assets/admin');?>/js/morris.min.js"></script>
<script src="<?=base_url('assets/admin');?>/js/raphael-2.1.0.min.js"></script>
<script>



$(document).ready(function(e) {

	$('#date').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy'
	}).focus(function() {
		$('select').addClass('form-control');
		$('select').css('width','100%');
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
//=============================================================
   var m1 = new Morris.Line({
        element: 'line-chart',
        data:<?=json_encode($LineChart['data'])?>,
        xkey: 'x',
        ykeys: <?=json_encode($LineChart['ykeys'])?>,
        labels: <?=json_encode($LineChart['labels'])?>,
        lineColors: <?=json_encode($LineChart['lineColors'])?>,
        lineWidth: '2px',
        hideHover: 'auto',
		parseTime: false,
		resize: true
    });
   
});
</script>