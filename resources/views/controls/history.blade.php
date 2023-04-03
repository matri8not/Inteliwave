@extends("layout")

@section("content")

<div class="p-3">
<div class="row ">
    <div class="cell-md-6">

        <div data-role="panel" data-title-caption="{{ trans('cruds.control.history') }}" data-collapsible="false" data-title-icon="<span class='mif-chart-line'></span>">

            <canvas id="canvas-status" width="600" height="300px" class="chartjs-render-monitor">
            </canvas>

            <div class="row">
                <div class="cell-6">
            <table class="table subcompact cell-border">
                <?php
                    if (Request::get('date')==null)
                        $start_day=Carbon\Carbon::now()->floorMonth();
                    else
                        $start_day=Carbon\Carbon::createFromFormat("m/Y", Request::get('date'))->floorMonth();
                    $delta = today()->floorMonth()->diffInMonths($start_day);
                    if ($start_day<today())
                        $delta = -$delta;
                ?>
                <tbody>
                    @for ($i=-12;$i<0;$i++) 
                    <?php
                        $first = today()->floorMonth()->addMonth($i+$delta);
                        $second = \Carbon\Carbon::today()->floorMonth()->addMonth($i+$delta)->endOfMonth();
                    ?>
                    <tr>
                        <td align="center">
                        <a href="/controls?period={{$i}}&domain=0&status=0">
                          <?php        
	                     echo $first->format("m/Y");
                          ?>
                        </a>
                        </td>
                        <td align="center">
                            <?php $count=0; ?>
                            @foreach ($controls as $control)
                                <?php
                                if (($control->score!=null) && 
                                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                                ) 
                                {
                                        $count++;
                                }
                                ?>
                            @endforeach
                            {{ $count }} 
                            /
                            <?php $count=0; ?>
                            @foreach ($controls as $control)
                                <?php
                                if (
                                    (
                                        ($control->score==null)&&
                                        (\Carbon\Carbon::parse($control->plan_date)->between($first, $second))
                                    )||
                                    (
                                        ($control->score!=null)&&
                                        (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                                    )
                                ) 
                                {
                                        $count++;
                                }
                                ?>
                            @endforeach
                            {{ $count }} 
                        </td>
                        <td  align="center">
                            <?php $count=0; ?>
                            @foreach ($controls as $control)
                                <?php
                                if (($control->score==1) &&
                                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                                ) {
                                        $count++;
                                }
                                ?>
                            @endforeach
                            <font color="red">   
                            @if ($count>0) {{ $count }} 
                                &nbsp; &#9679; 
                            @else
                                &nbsp; &nbsp; &nbsp; 
                            @endif
                            </font>
                        </td>
                        <td  align="center">
                            <?php $count=0; ?>
                            @foreach ($controls as $control)
                                <?php
                                if (($control->score==2) &&
                                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                                ) {
                                        $count++;
                                }
                                ?>
                            @endforeach          
                            <font color="orange">   
                            @if ($count>0) {{ $count }} 
                                &nbsp; &#9679; 
                            @else
                                &nbsp; &nbsp; &nbsp;
                            @endif
                            </font>
                        </td>
                        <td align="center"> 
                            <?php $count=0; ?>
                            @foreach ($controls as $control)
                                <?php
                                if (($control->score==3) &&
                                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                                ) {
                                        $count++;
                                }
                                ?>
                            @endforeach          
                            <font color="green">   
                            @if ($count>0) {{ $count }} &nbsp; &#9679; 
                            @else
                            &nbsp; &nbsp; &nbsp;
                            @endif
                            </font>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>

    <!----------------------------------------------------------->

    <div class="cell-6">
    <table class="table subcompact cell-border">
        <tbody>
        <?php 
        for ($i=0;$i<12;$i++) { 
            $first = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta);
            $second = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta)->endOfMonth();
            ?>
            <tr>
                <td align="center">
                <a href="/controls?period={{$i}}&domain=0&status=0">
                <?php        
	             echo $first->format("m/Y");
                ?>
                </a>
                </td>
                <td align="center">
                <?php $count=0; ?>
                    @foreach ($controls as $control)
                    <?php
                    if (($control->score!=null) &&
                        (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                    ) {
                            $count++;
                    }
                    ?>
                    @endforeach
                    {{ $count }} 
                    /
                    <?php $count=0; ?>
                    @foreach ($controls as $control)
                        <?php
                        if (
                            (
                                ($control->score==null) &&
                                (\Carbon\Carbon::parse($control->plan_date)->between($first, $second))
                            )||
                            (
                                ($control->score!=null) &&
                                (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                            )
                        ) {
                                $count++;
                        }
                        ?>
                    @endforeach
                    {{ $count }} 
                </td>
                <td  align="center">
                    <?php $count=0; ?>
                    @foreach ($controls as $control)
                        <?php
                        if (($control->score==1)
                            && (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                        ) {
                                $count++;
                        }
                        ?>
                    @endforeach
                    <font color="red">   
                    @if ($count>0) {{ $count }} &nbsp; &#9679; 
                    @else
                    &nbsp; &nbsp; &nbsp;
                    @endif
                    </font>
                </td>
                <td  align="center">
                    <?php $count=0; ?>
                    @foreach ($controls as $control)
                        <?php
                        if (
                            ($control->score==2) && 
                            (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                            ) 
                        {
                                $count++;
                        }
                        ?>
                    @endforeach          
                    <font color="orange">   
                    @if ($count>0) {{ $count }} &nbsp; &#9679; 
                    @else
                    &nbsp; &nbsp; &nbsp;
                    @endif
                    </font>
                </td>
                <td align="center"> 
                    <?php $count=0; ?>
                    @foreach ($controls as $control)
                        <?php
                        if (($control->score==3) && 
                            (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                        ) {
                                $count++;
                        }
                        ?>
                    @endforeach          
                    <font color="green">
                    @if ($count>0) {{ $count }} &nbsp; &#9679; 
                    @else
                    &nbsp; &nbsp; &nbsp;
                    @endif
                    </font>
                </td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>


<!------->

</div>

       </div>
    </div>

</div>

    <div class="cell-md-6">
        <div class="panel">

            <?php
            if (Request::get('date')!==null)
                $calendar = new \App\Calendar(Request::get('date'));
            else
                $calendar = new \App\Calendar(\Carbon\Carbon::now()->format('m/Y'));
            
            foreach ($controls as $control) {
                if (($control->score==null) && ($control->plan_date!=null)) {
                        $calendar->addEvent($control->clause, $control->plan_date, 1, 'grey', $control->id);
                    }
                else if (($control->score==1) && ($control->realisation_date!=null)) {
                        $calendar->addEvent($control->clause, $control->realisation_date, 1, 'red', $control->id);
                        }
                else if (($control->score==2) && ($control->realisation_date!=null)) {
                        $calendar->addEvent($control->clause, $control->realisation_date, 1, 'orange', $control->id);
                        }
                else if (($control->score==3) && ($control->realisation_date!=null)) {
                        $calendar->addEvent($control->clause, $control->realisation_date, 1, 'green', $control->id);
                    }
                }
            echo $calendar;
            ?>
        </div>
    </div>
</div>
</div>
</div>



</div>
</div>
</div>
</div>

<!------------------------------------------------------------------------------------->

<script src="/vendors/chartjs/Chart.bundle.min.js"></script>
<script src="/js/utils.js"></script>

<script>
    var color = Chart.helpers.color;
    var barChartData = {
        labels : [
        <?php 
        for ($i=-12;$i<12;$i++) { 
            $now = \Carbon\Carbon::now();
            echo '"';
            echo $now->startOfMonth()->addMonth($i+$delta)->format("m/Y");
            echo '",';
        }
        ?>
      ],
      datasets: [
      { 
        backgroundColor: "#60a917",
        borderColor: "#60a917",
        pointBackgroundColor: window.chartColors.green,        
        stack: 'Stack 0',
        data: [
            <?php 
            for ($i=-12; $i<12; $i++) { 
                $count=0; 
                $first = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta);
                $second = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta)->endOfMonth();
                ?>
            @foreach ($controls as $control)
                <?php
                if (($control->score==3) && 
                    ($control->realisation_date!=null) && 
                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                ) { $count++;
                }
                ?>
            @endforeach          
            {{ $count }},
            <?php } ?> 
        ]
      },
      { 
        backgroundColor: "#fa6800",
        borderColor: "#fa6800",
        pointBackgroundColor: window.chartColors.orange,        
        stack: 'Stack 0',
        data: [
            <?php 
            for ($i=-12; $i<12; $i++) { 
                $count=0; 
                $first = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta);
                $second = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta)->endOfMonth();
                ?>
            @foreach ($controls as $control)
                <?php
                if (($control->score==2) && 
                    ($control->realisation_date!=null) && 
                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                ) { $count++;
                }
                ?>
            @endforeach          
            {{ $count }},
            <?php } ?> 
        ]
      },
      { 
        backgroundColor: "#ce352c",
        borderColor: "#ce352c",
        pointBackgroundColor: window.chartColors.red,        
        stack: 'Stack 0',
        data: [
            <?php 
            for ($i=-12; $i<12; $i++) { 
                $count=0; 
                $first = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta);
                $second = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta)->endOfMonth();
                ?>
            @foreach ($controls as $control)
                <?php
                if (($control->score==1) &&
                    ($control->realisation_date!=null) && 
                    (\Carbon\Carbon::parse($control->realisation_date)->between($first, $second))
                ) {
                    $count++;
                }
                ?>
            @endforeach          
            {{ $count }},
            <?php } ?> 
        ]
      },
      { 
        backgroundColor: color(window.chartColors.grey).alpha(0.3).rgbString(),
        borderColor: window.chartColors.grey,
        pointBackgroundColor: window.chartColors.grey,        
        stack: 'Stack 0',
        data: [
            <?php 
            for ($i=-12; $i<12; $i++) { 
                $count=0; 
                $first = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta);
                $second = \Carbon\Carbon::today()->day(1)->addMonth($i+$delta)->endOfMonth();
                ?>
            @foreach ($controls as $control)
                <?php
                if (($control->score==null)
                    && ($control->plan_date!=null)
                    && (\Carbon\Carbon::parse($control->plan_date)->between($first, $second))
                ) {
                        $count++;
                }
                ?>
            @endforeach          
            {{ $count }},
            <?php } ?> 
        ]
      },
      ]
    };
         
    window.onload = function() {
        var ctx = document.getElementById('canvas-status').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    display: false,
                },
                title: {
                    display: false
                }
            }
        });

    };


    document.getElementById('canvas-status').onclick = function(evt){
            var activePoints = window.myBar.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            // var label = barChartData.labels[firstPoint._index];
            // alert(firstPoint._index - 12);
            // alert(barChartData.labels[firstPoint._index]);
            window.location.href="/control/history?date="+(barChartData.labels[firstPoint._index]);
        };

    window.addEventListener('load', function(){
        document.getElementById('date').addEventListener('change', function(){
            window.location = '/control/history?date=' + this.value;
        }, false);
    }, false);

    </script>

@endsection
