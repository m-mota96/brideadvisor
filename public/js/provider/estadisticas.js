$(document).ready(()=> {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'extractStatistic',
        method: 'get',
        success: (res)=> {
            chart(res.days, res.visits, res.requests, res.searches)
        },
        error: ()=> {
            console.log('ERROR');
        }
    });
});

function chart(days, visits, requests, searches) {
    console.log(days[0]);
    Highcharts.chart('graphic', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Estadísticas de los últimos 7 días'
        },
        subtitle: {
            text: 'Brideadvisor.mx'
        },
        xAxis: {
            categories: days
        },
        yAxis: {
            title: {
                text: 'Cantidad'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
            {
                name: 'Visitas',
                data: visits
            },
            {
                name: 'Solicitudes',
                data: requests
            },
            {
                name: 'Búsquedas de tu perfil',
                data: searches
            }
        ],
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
    });
}