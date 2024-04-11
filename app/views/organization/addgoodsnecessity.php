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
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/physicalgood'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add (Good) Necessities</h3>
                    <p>Enter correct information and add your necessities.</p>
                </div>

                <!-- Add goods Necessity Form -->
                <div class="add-necessity-form">
                    <form action="<?php echo URLROOT ?>/Necessity/addGoodsNecessity" method="post">
                        <!-- Necessity -->
                        <div class="add-necessity-one-line-input">
                            <label for="necessitygoods">Necessity </label>
                            <select id="necessityMonetary" name="necessityMonetary" value="<?php echo isset($data['necessityMonetary']) ? $data['necessityMonetary'] : ''; ?>">
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="EducationalSuppliesandTools" title="Pencils&#13Pens&#13Notebooks&#13Textbooks&#13Calculators&#13Educational software&#13Interactive whiteboards&#13Microscopes&#13Lab equipment&#13Robotics kits&#13Coding software&#13Coding software&#13Laptops&#13 3D printers">
                                        Educational Supplies and Tools
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="ClothingandAccessories" title="School uniforms&#13T-shirts&#13Pants&#13Shoes&#13Backpacks&#13Hats">
                                        Clothing and Accessories
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="RecreationandSportsEquipment" title="Soccer balls&#13Basketballs&#13Gymnastics mats&#13Tennis rackets&#13Bicycles&#13Skateboards">
                                        Recreation and Sports Equipment
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="HealthandWellnessProducts" title="Hygiene products (e.g., soap, toothpaste)&#13Hand sanitizer&#13Yoga mats">
                                        Health and Wellness Products
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="TransportationandMobility" title="Bicycles&#13Wheelchairs&#13Scooters&#13Crutches&#13Walking canes">
                                        Transportation and Mobility
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="LiteratureandReadingMaterials" title="Fiction books&#13Non-fiction books&#13Language learning materials&#13Dictionaries&#13E-readers&#13Audiobooks">
                                        Literature and Reading Materials
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="othernecessitycato">
                                        Other
                                    </option>
                                </select>
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
                            <textarea name="goodsnecessitydes" id="goodsnecessitydes" placeholder="Provide the item that belongs in the necessity category"><?php echo isset($data['goodsnecessitydes']) ? $data['goodsnecessitydes'] : ''; ?></textarea>
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
