function crearGrafica(cosPoints) {
// Some simple loops to build up data arrays.
console.log(cosPoints);
var plot3 = $.jqplot('chart1', cosPoints,/*[cosPoints] para ser individual*/
{
title: 'venta en carnes de cerdo',
        legend: {show: false},
        axes: {
        pad: 1,
                seriesDefaults: {
                renderer: $.jqplot.BarRenderer
                },
                xaxis: {
                render: $.jqplot.CategoryAxisRenderer,
                        label: 'eje x CANTIDADES DE CARNE',
//                        renderer: $.jqplot.DateAxisRenderer /*para poner fecha*/
                        renderer: $.jqplot.CategoryAxisRenderer/*poner letras en eje x*/
                },
                yaxis: {
//                        render: $.jqplot.CategoryAxisRenderer,
//                        label: 'eje y CANTIDADN DE CARNE',
//                        renderer: $.jqplot.CategoryAxisRenderer/*poner letras en eje x*/
                renderer: $.jqplot.CategoryAxisRenderer,
          label: 'eje y TIPO DE CARNE',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: {
              angle: 30,
              fontFamily: 'Courier New',
              fontSize: '9pt'
          }

                        },
                },
                series: [
                {
                lineWidth: 2,
                        markerOptions: {style: 'dimaond'}, shadow: false,
                },
                ]
        }
);
        }
//function crearGrafica(cosPoints) {
//    // Some simple loops to build up data arrays.
//    var plot3 = $.jqplot('chart1', [cosPoints],
//            {
//                title: 'Numeros de Sacrificio de los cerdos',
//                legend: {show: false},
//                axes: {
//                    pad: 1,
//                    xaxis: {
//                        render: $.jqplot.CategoryAxisRenderer,
//                        label: 'eje x',
////                        renderer: $.jqplot.DateAxisRenderer /*para poner fecha*/
//                    },
//                    yaxis: {
//                        render: $.jqplot.CategoryAxisRenderer,
//                        label: 'eje y',
//                    },
//                },
//                series: [
//                    {
//                        lineWidth: 2,
//                        markerOptions: {style: 'dimaond'}, shadow: false,
//                    },
//                ]
//            }
//    );
//}


