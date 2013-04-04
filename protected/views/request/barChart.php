<?php
/* @var $this RequestController */
/* @var $model Request */

//load kendo css and js files.
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/protected/vendors/kendo/styles/kendo.common.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/protected/vendors/kendo/styles/kendo.default.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/protected/vendors/kendo/styles/kendo.rtl.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/protected/vendors/kendo/js/jquery.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/protected/vendors/kendo/js/kendo.all.min.js', CClientScript::POS_HEAD);

//request type buttons goes to ButtonFilter(CMenu) widget.
$req_type = $this->getFilterValues('type_id','type');
$this->menu2=$req_type;

//request type buttons goes to ButtonFilter(CMenu) widget.
$dpt = $this->getFilterValues('dpt_id','dpt');
$this->menu=$dpt;

?>
<style>
    #chart {
        width: 600px;
    }
    #grid {
        width: 600px;
        direction:rtl;    
    }
    .k-grid-content{
        overflow-y: auto;
        text-align: right;
    }
    
</style>
<div id="filter_pane">
        <div id="date_range">
                    <div class="k-rtl" >
                        <label for="start">מתאריך:</label>
                        <input id="start" value="" />

                        <label for="end">עד תאריך:</label>
                        <input id="end" value=""/>
                    </div>


        </div>
</div>
<hr>
<div id="dashboard_pane" style="float: left">
    
<div id="example" >
            <div>
                <div id="chart" style="background: center no-repeat url('protected/vendors/kendo/styles/images/world-map.png');"></div>
                <div id="grid"></div>
            </div>
            
            <script>
                
                var items = [];
                var _items = {} ;
                function createJSON()
                {
                    _items = {};
                    items = [];
                    var i=0;
                    
                    
                    $('ul.selectionGroup').each(function(){
                        var fk_field = $(this).attr('fkfield');
                            $(this).children().each(function() {
                                
                              if ($(this).hasClass('selected'))
                              {
                                  var item = { id: $(this).attr('itemid') };
                                  items.push(item);
                                  i=1;
                              }
                            })
                        if (i==1)
                            {
                                _items[fk_field] = items;
                                i=0;
                            }
                        items = [];
                    });
                    
                   
                    _items = JSON.stringify(_items);
                   
                   }
                
                
                var ds1 = new kendo.data.DataSource({
                    transport: {
                        read: {
                            
                                    type: "POST",
                                    url: "http://localhost/crmc/index.php?r=request/returnJson",
                                    dataType: "json",
                                    data: {
                                        open_time_from: function() { 
                                            return $("#start").val();
                                        },
                                        open_time_to: function() { 
                                            return $("#end").val();
                                        },
                                        filters_array: function() {
                                            //count items in the _items Object
                                            var count = 0;
                                            for (var k in _items) {
                                                if (_items.hasOwnProperty(k)) {
                                                   ++count;
                                                }
                                            }
                                            
                                            if (count > 0)
                                                {
                                                    return _items;
                                                }
                                                else 
                                                    {
                                                        return null;
                                                    }
                                        }
                                        
                                    }
                            
                        }
                    }
                });
                //creaing the chart
                function createChart() {
                    $("#chart").kendoChart({
                      dataSource: ds1, /*{
                            transport: {
                                read: {
                                    type: "POST",
                                    url: "http://localhost/crmc/index.php?r=request/returnJson",
                                    dataType: "json",
                                    data: {
                                        open_time_from: function() { 
                                            return $("#start").val();
                                        },
                                        open_time_to: function() { 
                                            return $("#end").val();
                                        },
                                        filters_array: function() {
                                            //count items in the _items Object
                                            var count = 0;
                                            for (var k in _items) {
                                                if (_items.hasOwnProperty(k)) {
                                                   ++count;
                                                }
                                            }
                                            
                                            if (count > 0)
                                                {
                                                    return _items;
                                                }
                                                else 
                                                    {
                                                        return null;
                                                    }
                                        }
                                        
                                    }
                                }
                            },
                            sort: {
                                field: "open_day",
                                dir: "asc"
                            }
                        },*/
                        title: {
                            text: "פניות לקוחות לפי תאריך"
                        },
                        legend: {
                            position: "left"
                        },
                        seriesDefaults: {
                            type: "line"
                        },
                        series:
                        [{
                            field: "id",
                            //aggregate: "count",
                            name: "פניות"
                            
                            
                        }],
                        categoryAxis: {
                            field: "open_time",
                            //baseUnit: "weeks",
                            labels: {
                                rotation: -90
                                //format: "M/d"
                                
                            }
                            //type: "numeric",
                            
                            
                        },
                        valueAxis: {
                            labels: {
                                format: "N0"
                            },
                            majorUnit: 1
                        },
                        tooltip: {
                            visible: true,
                            format: "N0"
                        }
                        
                        
                    });
                }
                
                function createGrid() {
                    $("#grid").kendoGrid({
                        dataSource: ds1,
                        autoBind: false,
                        sortable: {
                            allowUnsort: false
                        },
                        columns: [
                            {
                                field: "open_time",
                                title: "תאריך פתיחה",
                                width: "100px"
                            },
                            {
                                field: "type_name",
                                title: "סוג פניה"
                                //template: '#= kendo.toString(value, "N0") #'
                            },
                            {
                                field: "id",
                                title: "כמות",
                                //template: '#= kendo.toString(growth, "p") #',
                                width: "100px"
                            },
                            {
                                field: "department_name",
                                title: "מחלקה"
                            }
                                
                        ]
                    });
                }
                
                $(document).ready(function() {
                    
                    /**
                     * make filter buttons selectable.
                     * every click add or remove a class which changes the item's background
                     * every click will make an ajax call and update the dataSource
                     **/
                    $(".selectionGroup").children("li").click(function(){
                       if ($(this).parent().attr('selectionType') == "multi")
                           {
                               //add selected class or remove for every click 
                               if(!$(this).hasClass('selected'))
                                   {
                                       $(this).addClass('selected');
                                   }
                                   else
                                       {
                                           $(this).removeClass('selected');
                                       }
                                   
                           }
                           else 
                               if ($(this).parent().attr('selectionType') == "radio")
                                   {
                                       //remove all li element 'selected' class.
                                         $(this).parent().children().each(function() {
                                            $(this).removeClass('selected'); 
                                         });
                                            
                                            //add 'selected' class to the li has been clicked.
                                            $(this).addClass('selected');
                                   }
                           
                           createJSON()
                           refresh();
                    });
                    
                    
                    
                    
                    
                    
                    setTimeout(function() {
                        // Initialize the chart with a delay to make sure
                        // the initial animation is visible
                        createChart();
                        createGrid();
                        $("#example").bind("kendo:skinChange", function(e) {
                            createChart();
                        });
                    }, 400);
                    
                    
                    $("#start").change(function(){
                        refresh();
                    });
                    $("#end").change(function(){
                        refresh();
                    });
                    
                    function refresh() {
                    var chart = $("#chart").data("kendoChart");
                        chart.dataSource.read();
                        chart.refresh();
                    }
                    
                    
                    /**
                     * 
                     * date range picker validation
                     * 
                     */
                    function startChange() {
                        var startDate = start.value(),
                        endDate = end.value();

                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

                    function endChange() {
                        var endDate = end.value(),
                        startDate = start.value();

                        if (endDate) {
                            endDate = new Date(endDate);
                            endDate.setDate(endDate.getDate());
                            start.max(endDate);
                        } else if (startDate) {
                            end.min(new Date(startDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

                    var start = $("#start").kendoDatePicker({
                        change: startChange,
                        format: "dd/MM/yyyy",
                        value: lastMonthDate()
                        
                    }).data("kendoDatePicker");

                    var end = $("#end").kendoDatePicker({
                        change: endChange,
                        format: "dd/MM/yyyy",
                        value: nowDate()
                    }).data("kendoDatePicker");

                    start.max(end.value());
                    end.min(start.value());
                    
                    //by default, the dates range will set to last 30 days.
                    function nowDate(){
                        var date = new Date();
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        return day + "/" + month + "/" + year;
                    }
                    function lastMonthDate(){
                        var today = new Date();
                        var sub30Days = new Date();
                        sub30Days.setDate(today.getDate()-30);
                        var day = sub30Days.getDate();
                        var month = sub30Days.getMonth() + 1;
                        var year = sub30Days.getFullYear();
                        return day + "/" + month + "/" + year;
                    }
                    
                });
            </script>
        </div>
    </div>

                