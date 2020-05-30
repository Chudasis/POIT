
var x = [];
var y = [];

var graph_data = {
    x: x,
    y: y,
    type: 'line',
    name: 'temperature',
    line: {
        color: '#8ed6ef',
    }  
};

var layout = {
    title: 'Vývoj teploty',
    plot_bgcolor: '#00000000',
    paper_bgcolor: '#00000000',
    xaxis: {
      title: 'Čas'
    },
    yaxis: {
      title: 'Teplota'
    }
  };

Plotly.newPlot('graph', [graph_data], layout);

$.post("graph_data.php",
    function (data){
        data = JSON.parse(data);
        for (var i in data) {
            x.push(data[i].time);
            y.push(data[i].temperature);
        }
        Plotly.redraw('graph');
    }
);
