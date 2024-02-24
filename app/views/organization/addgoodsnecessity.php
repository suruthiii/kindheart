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
                    <button onclick="location.href='<?php echo URLROOT ?>/organization/postedphysicalgoodsnecessity'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add (Good) Necessities</h3>
                    <p>Enter correct information and add your necessities.</p>
                </div>

                <!-- Add goods Necessity Form -->
                <div class="add-necessity-form">
                    <form action="" method="post">
                        <!-- Necessity -->
                        <div class="add-necessity-one-line-input">
                            <label for="necessitygoods">Necessity </label>
                            <input type="text" id="necessitygoods" name="necessitygoods" value="<?php echo isset($data['necessitygoods']) ? $data['necessitygoods'] : ''; ?>">
                            <!-- NecessityGoods Error Display for Goods-->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['necessitygoods_err']) ? $data['necessitygoods_err']: ''; ?></span>
                        </div>
                        <!-- Requested Amount -->
                        <div class="add-necessity-one-line-input">
                            <label for="requestedgoodsquantity">Requested Quantity </label>
                            <input type="number" id="requestedgoodsquantity" name="requestedgoodsquantity" value="<?php echo isset($data['requestedgoodsquantity']) ? $data['requestedgoodsquantity'] : ''; ?>">
                            <!-- Requested Ammount Error Display for Goods -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['requestedgoodsquantity_err']) ? $data['requestedgoodsquantity_err']: ''; ?></span>
                        </div>
                        <!-- Description about the necessity -->
                        <div class="add-necessity-text-area-input">
                            <label for="goodsnecessitydes">Description</label>
                            <textarea name="goodsnecessitydes" id="goodsnecessitydes"><?php echo isset($data['goodsnecessitydes']) ? $data['goodsnecessitydes'] : ''; ?></textarea>
                            <!-- Description about the necessisty error display for goods -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['goodsnecessitydes_err']) ? $data['goodsnecessitydes_err']: ''; ?></span>
                        </div>
                        <!-- Add button -->
                        <div class="add-necessity-add-button">
                            <input type="submit" value="Add">
                        </div>
                    </form>
                </div>

                

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
