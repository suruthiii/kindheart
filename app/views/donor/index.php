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
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
                    </div>
                    <div class="donor-dashboard-status">
                        <p>Donation Status</p>
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
                        <p>----------------</p>
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
                                <td>Donation</td>
                                <td>Date</td>
                                <td>Status</td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>                   
        </div>
    </section>
</main>

<h1>Donor Dashboard</h1>

<?php require APPROOT.'/views/inc/footer.php'; ?>
