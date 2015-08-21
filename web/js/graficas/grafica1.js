function crearGrafica(cosPoints) {
  // Some simple loops to build up data arrays.
  var plot3 = $.jqplot('chart1', [cosPoints],
          {
            title: 'Numeros de Sacrificio de los cerdos',
            // Series options are specified as an array of objects, one object
            // for each series.
            series: [
              {
                // Change our line width and use a diamond shaped marker.
                lineWidth: 2,
                markerOptions: {style: 'dimaond'}
              },
//              {
//                // Don't show a line, just show markers.
//                // Make the markers 7 pixels with an 'x' style
//                showLine: false,
//                markerOptions: {size: 7, style: "x"}
//              },
//              {
//                // Use (open) circlular markers.
//                markerOptions: {style: "circle"}
//              },
//              {
//                // Use a thicker, 5 pixel line and 10 pixel
//                // filled square markers.
//                lineWidth: 5,
//                markerOptions: {style: "filledSquare", size: 10}
//              }
            ]
          }
  );
}

