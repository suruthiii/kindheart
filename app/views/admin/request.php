<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "requests";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>View Requests</h3>
            <p style="margin-left: 10px">View the list of requests</p>
            <div class="req-list">
                <div class="list-title">
                    <h4>User name</h4>
                </div>
                <div class="list-items">
                    <table>
                        <!-- Request 1 -->
                        <tr>
                            <td class="name">
                                <h4>A.L.M.Callister</h4>
                            </td>
                            <td class="btn">
                                <button class="rev-btn">Review</button>
                            </td>
                        </tr>

                        <!-- Request 2 -->
                        <tr>
                            <td class="name">
                                <h4>A.L.M.Callister</h4>
                            </td>
                            <td class="btn">
                                <button class="rev-btn">Review</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
