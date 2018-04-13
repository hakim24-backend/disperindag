var baseUrl = "http://disperindag.jatimprov.go.id/@dm1nw3b/";
var rangeTahun = $('#range-tahun').val();
var rangeBulan = $('#range-bulan').val();
updateStatistik(rangeTahun,rangeBulan);


function updateStatistik(tahun,bulan)
{
	var url;

	if(tahun == 0){
		url = baseUrl+"site/visit-stats-year";	
	}else if(bulan > 0){
		var rangeDates = tahun+"-"+bulan;
		url = baseUrl+"site/visit-stats?start="+rangeDates+"-01&end="+rangeDates+"-31";	
	}else{
		url = baseUrl+"site/visit-stats-month?year="+tahun;	
	}
	

	$.getJSON(url, function (json) {
		var data = {
            labels: json.dates,
            datasets: [
                {
                    label: 'Kunjungan',
                    fill: false,
                    backgroundColor: 'rgba(6,6,6,0.4)',
                    borderColor: 'rgba(100,100,100,1)',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: 'rgba(100,100,100,1)',
                    pointBackgroundColor: '#fff',
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: 'rgba(100,100,100,1)',
                    pointHoverBorderColor: 'rgba(220,220,220,1)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 10,
                    data: json.visits,
                },
                {
                    label: 'Pengunjung',
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: 'rgba(75,192,192,0.4)',
                    borderColor: 'rgba(75,192,192,1)',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: 'rgba(75,192,192,1)',
                    pointBackgroundColor: '#fff',
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: 'rgba(75,192,192,1)',
                    pointHoverBorderColor: 'rgba(220,220,220,1)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 10,
                    data: json.visitors,
                }
            ]
        };

		var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                tooltips: {
                    mode: 'label',
                },
            }
        };
        $('#lineChart').remove(); 
  		$('#graph-container').append('<canvas id="lineChart" height="100px"><canvas>');
		var ctx = $('#lineChart').get(0).getContext('2d');
		new Chart(ctx,config);	
    });
}