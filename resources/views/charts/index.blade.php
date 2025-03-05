@extends('layouts.master')

@section('content')
    <div class="row py-3">
        <div class="row-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="chart-tasks-overview"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-2">
        <a href="{{route('wallets.index')}}" class="btn btn-outline-blue w-15">Back</a>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.ApexCharts) {
                let walletData = @json($wallets);

                let seriesData = walletData.map(wallet => ({
                    x: wallet.dropDownIncome ? wallet.dropDownIncome : wallet.dropDownExpense, // Use dropdown names as labels
                    y: wallet.amount,
                    fillColor: wallet.amount >= 0 ? "#28a745" : "#dc3545" // Green for income, Red for expense
                }));

                new ApexCharts(document.getElementById('chart-tasks-overview'), {
                    chart: {
                        type: "bar",
                        height: 320,
                        toolbar: { show: true },
                        animations: { enabled: true },
                    },
                    plotOptions: {
                        bar: { columnWidth: '50%', distributed: true }
                    },
                    dataLabels: { enabled: false },
                    fill: { opacity: 1 },
                    series: [{
                        name: "Transactions",
                        data: seriesData
                    }],
                    tooltip: { theme: 'dark' },
                    grid: {
                        padding: { top: -20, right: 0, left: -4, bottom: -4 },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        type: "category",
                        labels: { rotate: -45 },
                        tooltip: { enabled: true },
                        axisBorder: { show: false },
                    },
                    yaxis: { labels: { padding: 4 } },
                    colors: undefined,
                    legend: { show: true },
                }).render();
            }
        });

    </script>
@endsection


