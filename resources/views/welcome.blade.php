<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/@tailwindcss/forms@0.2.1/dist/forms.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

@php
$orders = [
    ['amount' => '$149.00', 'status' => 'Paid', 'number' => '4562', 'email' => 'jillian@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=3', 'date' => 'Nov 23, 5:06 AM'],
    ['amount' => '$85.50', 'status' => 'Pending', 'number' => '1234', 'email' => 'robert@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=4', 'date' => 'Nov 24, 10:15 AM'],
    ['amount' => '$200.99', 'status' => 'Paid', 'number' => '7890', 'email' => 'susan@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=5', 'date' => 'Nov 25, 2:45 PM'],
    ['amount' => '$45.00', 'status' => 'Failed', 'number' => '4567', 'email' => 'mike@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=6', 'date' => 'Nov 26, 8:30 AM'],
    ['amount' => '$120.75', 'status' => 'Refunded', 'number' => '3210', 'email' => 'lisa@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=7', 'date' => 'Nov 27, 9:00 AM'],
    ['amount' => '$99.99', 'status' => 'Paid', 'number' => '6543', 'email' => 'dave@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=8', 'date' => 'Nov 28, 11:20 AM'],
    ['amount' => '$150.25', 'status' => 'Pending', 'number' => '9821', 'email' => 'carol@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=9', 'date' => 'Nov 29, 7:10 PM'],
    ['amount' => '$65.00', 'status' => 'Failed', 'number' => '8765', 'email' => 'steven@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=10', 'date' => 'Nov 30, 3:50 PM'],
    ['amount' => '$175.50', 'status' => 'Paid', 'number' => '4321', 'email' => 'anna@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=11', 'date' => 'Dec 1, 12:00 PM'],
    ['amount' => '$134.20', 'status' => 'Pending', 'number' => '5678', 'email' => 'george@example.com', 'avatar' => 'https://i.pravatar.cc/300?img=12', 'date' => 'Dec 2, 5:30 PM'],
];
@endphp

    <main class="w-full px-64 flex justify-center pt-12">
        <div class="w-full flex flex-col gap-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

                <div class="flex gap-2">
                    <div>
                        <button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
                            <div>Daily</div>

                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div>
                        <button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
                            <div>All Products</div>

                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div>
                        <button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
                            <div>Last 30 days</div>

                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-2">
                <button class="px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700">
                    <div class="text-sm font-normal">All</div>
                    <div class="text-lg font-semibold">510</div>
                </button>

                <button class="px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-blue-700 border-2 border-blue-400">
                    <div class="text-sm font-normal">Paid</div>
                    <div class="text-lg font-semibold">456</div>
                </button>

                <button class="px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700">
                    <div class="text-sm font-normal">Failed</div>
                    <div class="text-lg font-semibold">42</div>
                </button>

                <button class="px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700">
                    <div class="text-sm font-normal">Refunded</div>
                    <div class="text-lg font-semibold">12</div>
                </button>
            </div>

            <div>
                <div class="relative h-[10rem] w-full">
                    <canvas id="chart" class="w-full"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="relative text-sm text-gray-800">
                        <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Search email, order #, or amount" class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            </div>

            <div>
                <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                    <thead>
                        <tr>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 shadow">
                                </div>
                            </th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <button class="flex items-center gap-2 group">
                                    <div>Order #</div>

                                    <div class="text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <button class="flex items-center gap-2 group">
                                    <div>Status</div>

                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <button class="flex items-center gap-2 group">
                                    <div>Customer</div>

                                    <div class="text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <button class="flex items-center gap-2 group">
                                    <div>Date</div>

                                    <div class="text-gray-400 hidden group-hover:block">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </th>
                            <th class="w-auto p-3 text-left flex justify-end text-sm font-semibold text-gray-900">
                                <button class="flex flex-row-reverse justify-start items-center gap-2 group">
                                    <div>Amount</div>

                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                {{-- ... --}}
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 shadow">
                                    </div>
                                </td>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    <div class="flex gap-1">
                                        <span class="text-gray-300">#</span>
                                        {{ $order['number'] }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    @if ($order['status'] === 'Paid')
                                        <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-green-600 text-xs bg-green-100 opacity-75">
                                            <div>{{ $order['status'] }}</div>

                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </div>
                                        </div>
                                    @elseif ($order['status'] === 'Failed')
                                        <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-red-600 text-xs bg-red-100 opacity-75">
                                            <div>{{ $order['status'] }}</div>

                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>
                                        </div>
                                    @elseif ($order['status'] === 'Pending')
                                        <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-gray-600 text-xs bg-gray-100 opacity-75">
                                            <div>{{ $order['status'] }}</div>

                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @elseif ($order['status'] === 'Refunded')
                                        <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-purple-600 text-xs bg-purple-100 opacity-75">
                                            <div>{{ $order['status'] }}</div>

                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full overflow-hidden">
                                            <img src="{{ $order['avatar'] }}" alt="Customer avatar">
                                        </div>

                                        <div>{{ $order['email'] }}<div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    {{ $order['date'] }}
                                </td>
                                <td class="w-auto whitespace-nowrap p-3 text-sm text-gray-800 font-semibold text-right">
                                    {{ $order['amount'] }}
                                </td>
                                <td class="whitespace-nowrap p-3 text-sm">
                                    <div class="flex items-center justify-end">
                                        <button aria-label="Reveal dropdown" class="rounded hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        const chart = document.getElementById('chart');

        new Chart(chart, {
          type: 'line',
          data: {
                labels: ['Nov 12', 'Nov 13', 'Nov 15', 'Nov 25', 'Nov 29', 'Dec 1'],
                datasets: [{
                    tension: 0.1,
                    label: 'Order amount',
                    data: [1100, 2400, 950, 1500, 3200, 2600],
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
        });
      </script>
</body>
</html>
