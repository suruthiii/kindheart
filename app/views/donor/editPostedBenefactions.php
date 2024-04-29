<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/postedBenefactions'">Go Back</button>
                    <!-- <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            // Use history.back() to navigate to the previous page in history
                            history.back();
                        }
                    </script> -->
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Edit Posted Benefactions</h3>
                    <p>Edit Your Benefactions</p>
                </div>

                <div class="two-column-container">
                    <!-- Left column for add-benefaction-form -->
                    <div class="left-column">
                        <!-- Add Benefaction Form -->
                        <div class="add-benefaction-form">
                            <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/benefaction/editPostedBenefactions" method="POST" onsubmit="return validateForm()">

                                <input type="text" name="benefactionID" value="<?php echo $data['benefactionID']?>" hidden required>
                            
                                <!-- Item -->
                                <div class="benefaction-first-div">
                                    <label for="itemBenefaction">Item</label>
                                    <input type="text" id="itemBenefaction" name="itemBenefaction" value="<?php print_r($data['benefaction_details']->itemName); ?>" disabled>

                                    <!-- Monetary necessity Error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['itemBenefaction_err']) ? $data['itemBenefaction_err']: ''; ?></span>
                                </div>                           

                                <!-- Description about requested necessity -->
                                <div class="add-benefaction-text-area-input-to-oneline">
                                    <label for="benefactionDescription">Description</label>
                                    <textarea name="benefactionDescription" id="benefactionDescription" cols="30" rows="10"><?php print_r($data['benefaction_details']->description) ?></textarea>

                                    <!-- Neccessity description error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['benefactionDescription_err']) ? $data['benefactionDescription_err']: ''; ?></span>
                                </div>
                                
                                <!-- Add Button for necessity -->
                                <div class="add-benefaction-add-button">
                                    <input type="submit" value="Update" >
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right column for chosen-photos-container -->
                    <div class="right-column">
                        <div class="right-column-inner">
                            <div class="chosen-photos-container" id="chosen-photos-container1">
                                <?php if (!empty($data['benefaction_details']->itemPhoto1)): ?>
                                    <img style="max-width: 250px; max-height: 250px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto1; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container2">
                                <?php if (!empty($data['benefaction_details']->itemPhoto2)): ?>
                                    <img style="max-width: 250px; max-height: 250px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto2; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container3">
                                <?php if (!empty($data['benefaction_details']->itemPhoto3)): ?>
                                    <img style="max-width: 250px; max-height: 250px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto3; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container4">
                                <?php if (!empty($data['benefaction_details']->itemPhoto4)): ?>
                                    <img style="max-width: 250px; max-height: 250px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto4; ?>">
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div>         
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/giveonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script>
        // Select Box Customization
        var x, i, j, l, ll, selElmnt, a, b, c;

        /*look for any elements with the class "select-box":*/
        x = document.getElementsByClassName("select-box");
        l = x.length;

        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;

            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);

            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");

            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function(e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
                });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                arrNo.push(i)
                } else {
                y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php if (isset($data['success']) && $data['success']) : ?>
    <script>
        Swal.fire({
            title: "Benefaction Updated Successfully!",
            showConfirmButton: true,
            timer: 30000,
            didOpen: () => {
                // Additional styling for success message
                const swalContainer = document.querySelector('.swal2-popup');
                if (swalContainer) {
                    swalContainer.style.border = '3px solid #00FF80';
                    swalContainer.style.backgroundColor = '#f9f9f9';
                }
                const swalTitle = document.querySelector('.swal2-title');
                if (swalTitle) {
                    swalTitle.style.fontSize = '15px';
                }
            }
        });
    </script>
<?php elseif (isset($data['fail']) && $data['fail']): ?>
    <script>
        Swal.fire({
            title: "Benefaction Update Failed!",
            showConfirmButton: true,
            timer: 30000,
            didOpen: () => {
                // Additional styling for failure message
                const swalContainer = document.querySelector('.swal2-popup');
                if (swalContainer) {
                    swalContainer.style.border = '3px solid red';
                    swalContainer.style.backgroundColor = '#f9f9f9';
                }
                const swalTitle = document.querySelector('.swal2-title');
                if (swalTitle) {
                    swalTitle.style.fontSize = '15px';
                }
            }
        });
    </script>
<?php endif; ?>


<?php require APPROOT.'/views/inc/footer.php'; ?>