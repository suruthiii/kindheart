<?php require APPROOT.'/views/inc/header.php'; ?>
<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-dashboard-container">

            <!-- Title container -->
            <div class="donor-dashboard-introduction">
                <h1>Welcome Back <b>....Name.....<b></h1>
                <p>Here's The Latest Updates</p>
            </div>

            <!-- Status container -->
            <div class="donor-dashboard-status-bar-container">
                <div class="donor-dashboard-status-topic">
                    <h4>Status</h4>
                </div>
                <div class="donor-dashboard-status-bar">
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                        <h1>12 300</h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                        <h1>12 300</h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                        <h1>12 300</h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                        <h1>12 300</h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                        <h1>12 300</h1>
                    </div>
                </div>
            </div>

            <div class="donor-dashboard-two-column-container">
                <div class="donor-dashboard-graph-container">
                    <!-- Graph container -->
                    <div class="donor-dashboard-status-topic">
                        <h4>Donation Summary</h4>
                    </div>
                    <div class="donor-dashboard-left-container">
                        <canvas id="donutChartContainer" width="600" height="600"></canvas>
                    </div>
                </div>
                
                <div class="donor-dashboard-donation-container">
                    <!-- Donation container -->
                    <div class="donor-dashboard-status-topic">
                        <h4>Recent Donations</h4>
                    </div>
                    <div class="donor-dashboard-right-container">
                        <table>
                            <tr>
                                <th>Donation</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>Donation 1</td>
                                <td>Date 1</td>
                                <td>Status 1</td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>                   
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const DATA_COUNT = 4;

        const data = {
            labels: ['Monetary', 'Physical Goods', 'Benefaction', 'Scholarship'],
            datasets: [{
                label: 'Dataset 1',
                data: Array.from({ length: DATA_COUNT }, () => Math.floor(Math.random() * 100)),
                backgroundColor: [
                    '#8e0000',
                    '#bf644f',
                    '#d38a78',
                    '#f3d7d0'
                ]
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true, // Use round legend markers
                            boxWidth: 10, // Set legend box width
                            padding: 20 // Padding between legend items
                        }
                    }
                }
            },
        };

        // Get the canvas element
        const canvas = document.getElementById('donutChartContainer');

        // Create the doughnut chart
        const ctx = canvas.getContext('2d');
        const myChart = new Chart(ctx, config);
    </script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
