@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                <span id="totalAdmin">10</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>News</h4>
                            </div>
                            <div class="card-body">
                                <span id="totalNews">42</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reports</h4>
                            </div>
                            <div class="card-body">
                                <span id="totalReports">1201</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Online Users</h4>
                            </div>
                            <div class="card-body">
                                <span id="totalOnlineUsers">47</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart Section -->
            <div class="row mt-4">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Statistik</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById("pieChart").getContext("2d");
            var totalAdmin = parseInt(document.getElementById("totalAdmin").innerText);
            var totalNews = parseInt(document.getElementById("totalNews").innerText);
            var totalReports = parseInt(document.getElementById("totalReports").innerText);
            var totalOnlineUsers = parseInt(document.getElementById("totalOnlineUsers").innerText);

            var data = {
                labels: ["Admin", "News", "Reports", "Online Users"],
                datasets: [{
                    data: [totalAdmin, totalNews, totalReports, totalOnlineUsers],
                    backgroundColor: ["#3498db", "#e74c3c", "#f1c40f", "#2ecc71"],
                    hoverBackgroundColor: ["#2980b9", "#c0392b", "#f39c12", "#27ae60"]
                }]
            };

            new Chart(ctx, {
                type: "pie",
                data: data
            });
        });
    </script>
@endpush
