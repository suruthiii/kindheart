<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/organization/choosethenecessityType'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted Physical Goods Necessities</h3>
                    <p>Last 30 Days</p>
                </div>

                <!-- Pending table -->
                <div class="posted-necessity-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-necessity-pending-table-grey-line"></div>
                <div class="posted-necessities-pending-table">
                    <table>
                        <?php foreach($data['pendingtablerow'] as $pendingtablerow): ?>
                            <tr>
                                <td>
                                    <?php
                                        if ($pendingtablerow->itemCategory == "Educational Supplies and Tools"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/stationary.png" width="55" height="55">'; 
                                        }elseif($pendingtablerow->itemCategory == "Clothing and Accessories"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/clothings.png" width="55" height="55">';
                                        }elseif($pendingtablerow->itemCategory == "Recreationand Sports Equipment"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/sports.png" width="55" height="55">';
                                        }elseif($pendingtablerow->itemCategory == "Health and Wellness Products"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/health.png" width="55" height="55">';
                                        }elseif($pendingtablerow->itemCategory == "Transportation and Mobility"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/transport.png" width="55" height="55">';
                                        }elseif($pendingtablerow->itemCategory == "Literature and Reading Materials"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/books.png" width="55" height="55">';
                                        }elseif($pendingtablerow->itemCategory == "other"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/other.png" width="55" height="55">';
                                        }
                                    ?>
                                </td>
                                <td><h4 class="pending-postednecessityTitle"><?php echo $pendingtablerow->necessityName?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $pendingtablerow->description?></p>
                                </td>
                                <td><p><?php echo $pendingtablerow->requestedQuantity?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/viewPendingPhysicalGoodsnecessity" method="POST">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td><button onclick="location.href='<?php echo URLROOT ?>/organization/choosethenecessityType'">
                                    <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg">
                                    </button>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/deleteGoodsNecessity" method="POST" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Completed Table -->
                <div class="posted-necessity-Completed-table-caption">
                    <p>Completed</p>
                </div>
                <div class="posted-necessity-Completed-table-grey-line"></div>
                <div class="posted-necessities-Completed-table">
                    <table>
                        <?php foreach($data['completetablerow'] as $completetablerow): ?>
                            <tr>
                                <td>
                                    <?php
                                        if ($completetablerow->itemCategory == "Educational Supplies and Tools"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/stationary.png" width="55" height="55">'; 
                                        }elseif($completetablerow->itemCategory == "Clothing and Accessories"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/clothings.png" width="55" height="55">';
                                        }elseif($completetablerow->itemCategory == "Recreationand Sports Equipment"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/sports.png" width="55" height="55">';
                                        }elseif($completetablerow->itemCategory == "Health and Wellness Products"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/health.png" width="55" height="55">';
                                        }elseif($completetablerow->itemCategory == "Transportation and Mobility"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/transport.png" width="55" height="55">';
                                        }elseif($completetablerow->itemCategory == "Literature and Reading Materials"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/books.png" width="55" height="55">';
                                        }elseif($completetablerow->itemCategory == "other"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/other.png" width="55" height="55">';
                                        }
                                    ?>
                                </td>
                                <td><h4 class="pending-postednecessityTitle"><?php echo $completetablerow->necessityName?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $completetablerow->description?></p>
                                </td>
                                <td><p><?php echo $completetablerow->requestedQuantity?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/viewCompletedPhysicalGoodsnecessity" method="POST">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $completetablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/deleteGoodsNecessity" method="POST" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $completetablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                <div class="add-necessity-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/addgoodsnecessity'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Necessities</h5>
                    </button>
                </div>
                

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    

                </div>
            </div>

        </div>
    </section>
</main>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
