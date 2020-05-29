var x = [];
var y1 = [];
var y2 = [];
var y3 = [];

var layout = {
    plot_bgcolor: '#00000000',
    paper_bgcolor: '#00000000',
  }; 
var trace1 = {
    x: x,
    y: y1,
    type: 'line',
    name: 'temperature',
    line: {
        color: 'black',
    }  
};

var trace2 = {
    x: x,
    y: y2,
    type: 'line',
    name: 'humidity',
    line: {
        color: '#88d6ed',
    }  
};
var trace3 = {
    x: x,
    y: y3,
    type: 'line',
    name: 'light',
    line: {
        color: '#ffd300b5',
    }  
};
Plotly.newPlot('graph', [trace1, trace2, trace3], layout);

$(document).ready(function() {
        setInterval(function () {
            $.post("actuall_graph.php",
            function (data)
            {   
                var trace1 = {
                    x: x,
                    y: y1,
                    type: 'line',
                    name: 'Teplota',
                    line: {
                        color: 'black',
                    }  
                };
                
                var trace2 = {
                    x: x,
                    y: y2,
                    type: 'bar',
                    name: 'Vlhkosť',
                    marker: {
                        color: '#88d6ed',
                    }  
                };
                var trace3 = {
                    x: x,
                    y: y3,
                    type: 'bar',
                    name: 'Svietivosť',
                    marker: {
                        color: '#ffd300b5',
                    }  
                };

                data = JSON.parse(data);
                for (var i in data) {
                        x.push(data[i].time);
                        y1.push(data[i].temperature);
                        y2.push(data[i].humidity);
                        y3.push(data[i].light);
                }
            Plotly.newPlot('graph', [trace1, trace2, trace3], layout);
            x = [];
            y1 = [];
            y2 = [];
            y3 = [];
            });
        }, 1000);
    });
