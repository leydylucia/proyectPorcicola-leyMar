function crearGrafica(cosPoints, labels, datoMaximo) {
// Some simple loops to build up data arrays.
    console.log(cosPoints);
//    var cosPoints = [
//        [['costilla 1', 1], ['costilla 2', 3], ['pulpa 1', 4], ['pulpa 2', 5], ['menudo 1', 6], ['menudo 2', 7]],
//        [['costilla 1', 5], ['costilla 2', 2], ['pulpa 1', 1], ['pulpa 2', 3], ['menudo 1', 8], ['menudo 2', 2]],
//        [['costilla 1', 2], ['costilla 2', 1], ['pulpa 1', 6], ['pulpa 2', 2], ['menudo 1', 10], ['menudo 2', 12]]
//    ];
    var plot3 = $.jqplot('chart1', cosPoints, /*[cosPoints] para ser individual*/
            {
//title: 'venta en carnes de cerdo',
                legend: {
                    show: true,
                    location: 'e',
                    placement: 'outside',
                    labels: labels
                },
                axes: {
                    pad: 1,
                    xaxis: {
                        label: 'TIPO DE CARNE',
                        renderer: $.jqplot.CategoryAxisRenderer /*poner letras en eje x*/
                    },
                    yaxis: {
                        label: 'CANTIDADES DE CARNE EN KL',
                        max: datoMaximo,
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


