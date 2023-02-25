(function(){

    const ct = document.querySelector('#gifts-chart');

    if(ct){
        getData()
        async function getData(){
            const url = '/api/gift';
            const answer = await fetch(url);
            const result = await answer.json();
            console.log('hola');

            const ctx = document.getElementById('gifts-chart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: result.map(gift => gift.name),
                    datasets: [{
                        label: '',
                        data: result.map(gift => gift.total),
                        backgroundColor: [
                            '#ea580c',
                            '#84cc16',
                            '#22d3ee',
                            '#a855f7',
                            '#ef4444',
                            '#14b8a6',
                            '#db2777',
                            '#e11d48',
                            '#7e22ce'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugin: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }
})();