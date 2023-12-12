@props(['data'])

<div>
    <div class="relative h-[10rem] w-full" x-data="chart($el)" wire:ignore>
        <canvas id="chart" class="w-full"></canvas>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    let chart

    $wire.on('update-chart', ({ data }) => {
        let { labels, values, max } = data

        chart.data.labels = labels
        chart.data.datasets[0].data = values
        chart.update()
    })

    Alpine.data('chart', (el) => {
        let canvasEl = el.querySelector('canvas')

        let { labels, values, max } = { labels: [], values: [], max: 0 }

        chart = new Chart(canvasEl, {
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

        return {}
    })
</script>
@endscript
