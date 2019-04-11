<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Charts\Test;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
    
     public function testChart()
    {
    	$sales = Sale::select('price','created_at')->get();
		foreach ($sales as $sale)
    		{
    			$timestp = Carbon::createFromFormat('Y-m-d H:i:s' ,$sale->created_at ,'America/Chicago')->timestamp*1000;
    			$values[] = array($timestp,$sale->price);
    			$price = $sale->price;
    			$timestp2 = Carbon::createFromFormat('Y-m-d H:i:s' ,$sale->created_at ,'America/Chicago')->timestamp*1000;
    			$values2[] = array($timestp,$sale->price);
    		}
    		
    		
		$chart = new Test;
		//$chart->dataset('Series 1', 'line', $values);
		$chart->dataset('Series 2', 'line', [[1553760486000,896],[1553846886000,366],[1553933286000,818],[1554019686000,858],[1554106086000,802],[1554192486000,397],[1554278886000,831],[1554365286000,764],[1554451686000,984],[1554538086000,1],[1554624486000,915],[1554710886000,361],[1554797286000,161],[1554883686000,756],[1554970086000,659],[1555056486000,644],[1555142886000,252],[1555229286000,395],[1555315686000,285],[1555402086000,570],[1555488486000,685],[1555574886000,895],[1555661286000,99],[1555747686000,16],[1555834086000,165],[1555920486000,687],[1556006886000,42],[1556093286000,4],[1556179686000,578],[1556266086000,1],[1556352486000,845],[1556438886000,465],[1556525286000,107],[1556611686000,927],[1556698086000,828],[1556784486000,29],[1556870886000,657],[1556957286000,38],[1557043686000,236],[1557130086000,825],[1557216486000,875],[1557302886000,511],[1557389286000,108],[1557475686000,699],[1557562086000,440],[1557648486000,941],[1557734886000,651],[1557821286000,55],[1557907686000,370],[1557994086000,510],[1558080486000,78],[1558166886000,259],[1558253286000,799],[1558339686000,235],[1558426086000,756],[1558512486000,108],[1558598886000,525],[1558685286000,203],[1558771686000,611],[1558858086000,648],[1558944486000,179],[1559030886000,815],[1559117286000,326],[1559203686000,194],[1559290086000,557],[1559376486000,472],[1559462886000,711],[1559549286000,740],[1559635686000,28],[1559722086000,300],[1559808486000,164],[1559894886000,377],[1559981286000,455],[1560067686000,514],[1560154086000,255],[1560240486000,621],[1560326886000,35],[1560413286000,143],[1560499686000,779],[1560586086000,86],[1560672486000,128],[1560758886000,839],[1560845286000,60],[1560931686000,675],[1561018086000,324],[1561104486000,560],[1561190886000,932],[1561277286000,595],[1561363686000,939],[1561450086000,926]]);
		$chart->options([
			'xAxis'=> [
    			'type' => 'datetime',
        		'dateTimeLabelFormats' => [
            		'millisecond' => '%H:%M:%S.%L',
   	 				'second' => '%H:%M:%S',
    				'minute' => '%H:%M',
    				'hour' => '%H:%M',
    				'day' => '%e. %b',
    				'week' => '%e. %b',
    				'month' => '%b \'%y',
    				'year' => '%Y'
        		]
    		],
    		 'chart'=> [
        'type' => 'line',
        'zoomType' => 'x'
    ],
		]);

        return view('chart', ['chart' => $chart]);
        
        /*
        $chart->labels(['One', 'Two', 'Three', 'Four']);
		$chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
		$chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);
		*/
    }
    
    public function analytics(Request $request, $startdate, $enddate)
    {
    	
    	$startdate = Carbon::createFromFormat('m-d-Y', $startdate);
    	$enddate = Carbon::createFromFormat('m-d-Y', $enddate);
    	$sales = DB::table('sales')->whereBetween('created_at', [$startdate, $enddate])->get();
    	foreach ($sales as $sale)
    		{
    			$timestp = Carbon::createFromFormat('Y-m-d H:i:s' ,$sale->created_at ,'America/Chicago')->timestamp*1000;
    			$values[] = array($timestp,$sale->price);
    		}
    	return $values;
    	
        
    }

    public function data()
    {
    	
        $sales =  Sale::all();
        return view('viewsales', compact('sales'));
    	
        
    }
}
