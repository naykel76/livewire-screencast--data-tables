<div>
    <div class="relative h-[10rem] w-full" wire:ignore wire:loading.class="opacity-50 grayscale-[50%]">
        <canvas class="w-full"></canvas>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    let chart

    $wire.on('update-chart', ({ data }) => {
        if (chart) {
            updateChart(data)
        } else {
            setTimeout(() => {
                chart = initializeChart(
                    $wire.$el.querySelector('canvas'),
                    data
                )
            })
        }
    })

    function updateChart(data) {
        let { labels, values } = data

        chart.data.labels = labels
        chart.data.datasets[0].data = values
        chart.update()
    }

    function initializeChart(el, data) {
        let { labels, values } = data

        return new Chart(el, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    tension: 0.1,
                    label: 'Order amount',
                    data: values,
                    fill: {
                        target: 'origin',
                        above: '#1d4fd810',
                    },
                    pointStyle: 'circle',
                    pointRadius: 0,
                    pointBackgroundColor: '#5ba5e1',
                    pointBorderColor: '#5ba5e1',
                    pointHoverRadius: 4,
                    borderWidth: 2,
                }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    displayColors: false,
                },
            },
            hover: {
                mode: 'index',
                intersect: false
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                },
            },
            scales: {
                x: {
                    display: false,
                    // bounds: 'ticks',
                    border: { dash: [5, 5] },
                    ticks: {
                        // display: false,
                        // mirror: true,
                        callback: function(val, index, values) {
                            let label = this.getLabelForValue(val)

                            return index === 0 || index === values.length - 1 ? '' : label;
                        }
                    },
                    grid: {
                        border: {
                            display: false
                        },
                    },
                },
                y: {
                    display: false,
                    border: { display: false },
                    beginAtZero: true,
                    grid: { display: false },
                    ticks: {
                        display: false
                    },
                },
            }
            }
        })
    }
</script>
@endscript
