<html>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<link href="https://btn.ninja/css/bootstrap.css" rel="stylesheet">
	<link href="https://btn.ninja/css/addons.css" rel="stylesheet"">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <head>
        <meta charset="utf-8">
        <title>Chart with VueJS</title>

    </head>
    <body>
    <form style="width:500px; margin:20px auto;">
<div class="input-group input-daterange jDaterange">
    <input type="text" id="startdate" class="form-control" placeholder="mm-dd-yyyy">
    <div class="input-group-addon">to</div>
    <input type="text" id="enddate" class="form-control" placeholder="mm-dd-yyyy">
</div>
  <div id="submit"> Submit</div>
</form>


        <div id="app">
        
            {!! $chart->container() !!}
        </div>
        
        <div id="chart">
      <apexchart type=area height=350 :options="chartOptions" :series="series" />
    </div>
        <script src="https://unpkg.com/vue"></script>
        <script>
            var app = new Vue({
                el: '#app',
            });
        </script>
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
       
        {!! $chart->script() !!}
        <script>

  		$('.jDatepicker').datepicker({
  //calendarWeeks: true,  
  todayHighlight: false,
  format: "mm-dd-yyyy",
  autoclose: true
});

$('.jDaterange').datepicker({
  todayHighlight: false,
  format: "mm-dd-yyyy",
  autoclose: true
});
var startdate = $("input#startdate").val();
var enddate = $("input#enddate").val();

$('#submit').click(function(){
            axios.get('/analytics/'+$("input#startdate").val()+'/'+$("input#enddate").val())
  			.then(function (response) {
    			Highcharts.chart('{!! $chart->id !!}', {
    			 xAxis: {
        			type: 'datetime',
        			dateTimeLabelFormats: {
            			millisecond: '%H:%M:%S.%L',
    					second: '%H:%M:%S',
    					minute: '%H:%M',
    					hour: '%H:%M',
    					day: '%e. %b',
    					week: '%e. %b',
    					month: '%b \'%y',
    					year: '%Y'
        				}
    			},
    			chart: {
        			type :'line',
       				 zoomType:'x'
    			},
    			rangeSelector: {
        			selected: 1
    			},
      			series: [{
          			data: response.data
       					}]
					})
    		console.log(response);
  		});
});

  		</script>
        
</html>
<style>
/* the icons */

.input-datepicker, 
.input-daterange,
.input-daterange .input-group-addon { position:relative; }

.input-datepicker .form-control, 
.input-daterange .form-control { padding-left:32px; }

.input-datepicker:before,
.input-daterange:before,
.input-daterange .input-group-addon:before { 
	content: "\e916"; 
	font-family: 'Material Icons' !important;
	font-weight: normal;
	font-style: normal;
	font-size: 16px;
	line-height: 1;
	letter-spacing: normal;
	text-transform: none;
	white-space: nowrap;
	word-wrap: normal;
  position:absolute; z-index:9; 
  pointer-events: none; 
}

.input-datepicker:before {
  top:9px; left:8px; }

.input-daterange:before {
  top:9px; left:8px; }

.input-daterange .input-group-addon:before {
  top:9px; left:100%; margin-left: 8px; }
  </style>