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
                <h1><?php echo $data['title']; ?></h1>
                <p>Here's The Latest Updates</p>
            </div>

            <!-- Status container -->
            <div class="donor-dashboard-status-bar-container">
                <div class="donor-dashboard-status-topic">
                    <h4>Status</h4>
                </div>
                <div class="donor-dashboard-status-bar">
                    <div class="donor-dashboard-status">
                        <p>Active Donors</p>
                        <h1><?php echo $data['active_donors']?></h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Active Donees</p>
                        <h1><?php echo $data['active_donees']?></h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Total Goods Donations</p>
                        <h1><?php echo $data['total_goods_quantity']?></h1>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Total Monetary Donations</p>
                        <h1><?php echo $data['total_monetary_quantity']?></h1>
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
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>Books</td>
                                <td>5</td>
                                <td>Pending</td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>                   
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script>
    // Function to fetch data from the backend
    async function fetchDataAndUpdateChart() {
        try {
            const response = await fetch('/api/data'); // Replace '/api/data' with your actual backend endpoint
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const responseData = await response.json();

            // Extract data from the response
            const labels = responseData.labels; // Array of label names
            const values = responseData.values; // Array of numeric values

            // Update chart data
            config.data.labels = labels;
            config.data.datasets[0].data = values;

            // Redraw the chart
            myChart.update();
        } catch (error) {
            console.error('Error fetching or updating data:', error);
        }
    }

    // Chart configuration
    const config = {
        type: 'doughnut',
        data: {
            labels: [], // Initialize empty labels array
            datasets: [{
                label: 'Dataset 1',
                data: [], // Initialize empty data array
                backgroundColor: [
                    '#8e0000',
                    '#bf644f',
                    '#d38a78',
                    '#f3d7d0'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    align: 'start',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10,
                        padding: 20
                    }
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 50,
                    top: 10,
                    bottom: 10
                }
            },
            aspectRatio: 2, // Aspect ratio of width to height
            maintainAspectRatio: false // Allow chart to resize based on container
        }
    };

    // Get the canvas element
    const canvas = document.getElementById('donutChartContainer');

    // Create the doughnut chart
    const ctx = canvas.getContext('2d');
    const myChart = new Chart(ctx, config);

    // Call the function to fetch data and update the chart
    fetchDataAndUpdateChart();
</script> -->


<script>
        const DATA_COUNT = 5;

        const data = {
            labels: ['Monetary', 'Physical Goods', 'Benefaction', 'Scholarship', 'Project'],
            datasets: [{
                label: 'Dataset 1',
                data: Array.from({ length: DATA_COUNT }, () => Math.floor(Math.random() * 100)),
                backgroundColor: [
                    '#8e0000',
                    '#bf644f',
                    '#d38a78',
                    '#f3d7d0',
                    '#g3d8d1'
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
                    align: 'start',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10,
                        padding: 20
                    }
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 50,
                    top: 10,
                    bottom: 10
                }
            },
            aspectRatio: 2, // Aspect ratio of width to height
            maintainAspectRatio: false // Allow chart to resize based on container
        },
    };

        // Get the canvas element
        const canvas = document.getElementById('donutChartContainer');

        // Create the doughnut chart
        const ctx = canvas.getContext('2d');
        const myChart = new Chart(ctx, config);
    </script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
