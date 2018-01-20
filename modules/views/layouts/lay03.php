<!DOCTYPE html>
<html>
<head>
    <title>Yii商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="assets/admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="assets/admin/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="assets/admin/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="assets/admin/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="assets/admin/css/compiled/index.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>


<?= $content ?>




<!-- scripts -->
<script src="assets/admin/js/jquery-latest.js"></script>
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/jquery-ui-1.10.2.custom.min.js"></script>
<!-- knob -->
<script src="assets/admin/js/jquery.knob.js"></script>
<!-- flot charts -->
<script src="assets/admin/js/jquery.flot.js"></script>
<script src="assets/admin/js/jquery.flot.stack.js"></script>
<script src="assets/admin/js/jquery.flot.resize.js"></script>
<script src="assets/admin/js/theme.js"></script>

<script type="text/javascript">
    $(function () {

        // jQuery Knobs
        $(".knob").knob();



        // jQuery UI Sliders
        $(".slider-sample1").slider({
            value: 100,
            min: 1,
            max: 500
        });
        $(".slider-sample2").slider({
            range: "min",
            value: 130,
            min: 1,
            max: 500
        });
        $(".slider-sample3").slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 40, 170 ],
        });



        // jQuery Flot Chart
        var visits = [[1, 50], [2, 40], [3, 45], [4, 23],[5, 55],[6, 65],[7, 61],[8, 70],[9, 65],[10, 75],[11, 57],[12, 59]];
        var visitors = [[1, 25], [2, 50], [3, 23], [4, 48],[5, 38],[6, 40],[7, 47],[8, 55],[9, 43],[10,50],[11,47],[12, 39]];

        var plot = $.plot($("#statsChart"),
            [ { data: visits, label: "注册量"},
                { data: visitors, label: "访客量" }], {
                series: {
                    lines: { show: true,
                        lineWidth: 1,
                        fill: true,
                        fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                    },
                    points: { show: true,
                        lineWidth: 2,
                        radius: 3
                    },
                    shadowSize: 0,
                    stack: true
                },
                grid: { hoverable: true,
                    clickable: true,
                    tickColor: "#f9f9f9",
                    borderWidth: 0
                },
                legend: {
                    // show: false
                    labelBoxBorderColor: "#fff"
                },
                colors: ["#a7b5c5", "#30a0eb"],
                xaxis: {
                    ticks: [[1, "一月"], [2, "二月"], [3, "三月"], [4,"四月"], [5,"五月"], [6,"六月"],
                        [7,"七月"], [8,"八月"], [9,"九月"], [10,"十月"], [11,"十一月"], [12,"十二月"]],
                    font: {
                        size: 12,
                        family: "Open Sans, Arial",
                        variant: "small-caps",
                        color: "#697695"
                    }
                },
                yaxis: {
                    ticks:3,
                    tickDecimals: 0,
                    font: {size:12, color: "#9da3a9"}
                }
            });

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y - 30,
                left: x - 50,
                color: "#fff",
                padding: '2px 5px',
                'border-radius': '6px',
                'background-color': '#000',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#statsChart").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);

                    var month = item.series.xaxis.ticks[item.dataIndex].label;

                    showTooltip(item.pageX, item.pageY,
                        item.series.label + " of " + month + ": " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    });
</script>

</body>
</html>