@extends("layouts.app")

@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __("Dashboard") }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Total Price Chart -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Price</h4>
                            <canvas id="totalPriceChart" style="height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Average Price Chart -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Average Price</h4>
                            <canvas id="averagePriceChart" style="height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Total Days Rented Chart -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Days Rented</h4>
                            <canvas id="totalDaysChart" style="height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Average Days Rented Chart -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Average Days Rented</h4>
                            <canvas id="averageDaysChart" style="height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    @push("script-alt")
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Total Price Chart
                var ctxPrice = document.getElementById('totalPriceChart').getContext('2d');
                new Chart(ctxPrice, {
                    type: 'bar',
                    data: {
                        labels: ['Total Price'],
                        datasets: [{
                            label: 'Total Price',
                            data: [@json($totalPrice)],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp.' + value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Average Price Chart
                var ctxAvgPrice = document.getElementById('averagePriceChart').getContext('2d');
                new Chart(ctxAvgPrice, {
                    type: 'bar',
                    data: {
                        labels: ['Average Price'],
                        datasets: [{
                            label: 'Average Price',
                            data: [@json($averagePrice)],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp.' + value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Total Days Rented Chart
                var ctxDays = document.getElementById('totalDaysChart').getContext('2d');
                new Chart(ctxDays, {
                    type: 'bar',
                    data: {
                        labels: ['Total Days Rented'],
                        datasets: [{
                            label: 'Total Days Rented',
                            data: [@json($totalDaysRented)],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Average Days Rented Chart
                var ctxAvgDays = document.getElementById('averageDaysChart').getContext('2d');
                new Chart(ctxAvgDays, {
                    type: 'bar',
                    data: {
                        labels: ['Average Days Rented'],
                        datasets: [{
                            label: 'Average Days Rented',
                            data: [@json($averageDaysRented)],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
