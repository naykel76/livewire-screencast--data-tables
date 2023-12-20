<div>
    <div x-data="chart" class="relative h-[10rem] w-full overflow-hidden">
        <canvas class="w-full"></canvas>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    Alpine.data('chart', () => {
        return {
            init() {
                this.initChart()
            },

            initChart() {
                let el = this.$wire.$el.querySelector('canvas')

                let { labels, values } = {
                    labels: ['foo', 'bar', 'baz'],
                    values: [1, 2, 3],
                }

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
                                border: { dash: [5, 5] },
                                ticks: {
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
                        },
                    },
                })
            },
        }
    })
</script>
@endscript
