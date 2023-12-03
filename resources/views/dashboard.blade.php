<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded bg-white dark:bg-gray-800">
                    <div class="text-center">
                        <p class="text-2xl text-gray-900 dark:text-gray-500">
                            Pemesanan
                        </p>
                        <p class="text-xl text-red-400 dark:text-gray-500">
                            {{ $bookingThisMonth }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-white dark:bg-gray-800">
                    <div class="text-center">
                        <p class="text-2xl text-gray-900 dark:text-gray-500">
                            Kendaraan
                        </p>
                        <p class="text-xl text-green-400 dark:text-gray-500">
                            {{ $vehicleThisMonth }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-white dark:bg-gray-800">
                    <div class="text-center">
                        <p class="text-2xl text-gray-900 dark:text-gray-500">
                            Sopir
                        </p>
                        <p class="text-xl text-blue-400 dark:text-gray-500">
                            {{ $driverThisMonth }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center h-96 mb-4 rounded bg-white dark:bg-gray-800">
                <div id="labels-chart" class="px-2.5 w-full h-full "></div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
          let options = {
            // set the labels option to true to show the labels on the X and Y axis
            xaxis: {
              show: true,
              categories: {!! json_encode($months) !!},
              labels: {
                show: true,
                style: {
                  fontFamily: "Inter, sans-serif",
                  cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
              },
              axisBorder: {
                show: false,
              },
              axisTicks: {
                show: false,
              },
            },
            yaxis: {
              show: true,
              labels: {
                show: true,
                style: {
                  fontFamily: "Inter, sans-serif",
                  cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function (value) {
                  return value;
                }
              }
            },
            series: [
              {
                name: "Pemesanan",
                data: {!! json_encode($bookingCounts) !!},
                color: "#1A56DB",
              },
            ],
            chart: {
              sparkline: {
                enabled: false
              },
              height: "100%",
              width: "100%",
              type: "area",
              fontFamily: "Inter, sans-serif",
              dropShadow: {
                enabled: false,
              },
              toolbar: {
                show: false,
              },
            },
            tooltip: {
              enabled: true,
              x: {
                show: false,
              },
            },
            fill: {
              type: "gradient",
              gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
              },
            },
            dataLabels: {
              enabled: false,
            },
            stroke: {
              width: 6,
            },
            legend: {
              show: false
            },
            grid: {
              show: false,
            },
          }
      
          if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("labels-chart"), options);
            chart.render();
          }
        });
    </script>
</x-app-layout>
