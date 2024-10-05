<?php
if ($_GET['export'] == 1) {
	ebook_store_export_orders();
	die();
}
?>
<div class=wrap>
<h1 class="wp-heading-inline"><?php echo __('eBook Store', 'ebook-store'); ?></h1>

 <a href="edit.php?post_type=ebook&page=ebook-store-order_reports&export=1" class="page-title-action"><?php echo __('Export as CSV', 'ebook-store'); ?></a>
<hr class="wp-header-end">
</div>
  <script src="https://www.google.com/jsapi" type="text/javascript"></script>
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', '<?php echo get_option('paypal_currency'); ?>');
        
        data.addRows([

<?php

$data30days = ebook_store_stats_report_30days();

	foreach ($data30days as $key => $value) {
		$lines[] = "['" . $key . "', " . $value . "]";
	}

echo implode(",\n", 	$lines);
?>
]);
          //alert(jQuery('#chart_div').width());
        var options = {
          width: '100%', height: 500,
          title: '<?php echo __('Sales for the last month', 'ebook-store'); ?>',
          hAxis: {title: 'Date', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div30days'));
        chart.draw(data, options);
        jQuery('#chart_div30days svg').width('100%');
      }
    </script>
<div id="chart_div30days"></div>



  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', '<?php echo get_option('paypal_currency'); ?>');
        
        data.addRows([

<?php

$data2years = ebook_store_stats_report_2years();
unset($lines);
	foreach ($data2years as $key => $value) {

		$lines[] = "['" . $key . "', " . $value . "]";
	}

echo implode(",\n", 	$lines);
?>
]);
          //alert(jQuery('#chart_div').width());
        var options = {
          width: '100%', height: 500,
          title: '<?php echo __('Sales for the last 2 years', 'ebook-store'); ?>',
          hAxis: {title: 'Date', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_2years'));
        chart.draw(data, options);
        jQuery('#chart_div_2years svg').width('100%');
      }
    </script>
<div id="chart_div_2years"></div>
