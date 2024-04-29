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

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Donee Posted Nessities</h3>
                    <p>View Monetary Nessities Posted By Donees</p>
                </div>

                <div class="posted-nessesity-container">    
                <?php foreach ($data['scholarships'] as $item) { ?>
                    <div class="card">

                        <div class="course"> 
                            <div class="preview">
                                <h6><?php echo $item->duration; ?> months</h6>
                                <h2><?php echo $item->amount; ?> LKR</h2>

                            </div>
                            <div class="info"> 
                                <div class="info_text">
                                    <h6><?php echo $item->postedDate; ?></h6>
                                    <h2><?php echo $item->title; ?></h2>
                                </div>
                                <div class="btn">
                                    <form action="<?php echo URLROOT ?>/necessity/postedNessities" method="GET" >
                                        <input type="text" name="scholarshipID" id="scholarshipID" hidden value="<?php echo $item->scholarshipID?>" />
                                
                                        <?php if ($item->studentID == $_SESSION['user_id']){?>
                                            <h4> Already Applied</h4>
                                        <?php } else{?>
                                            <button type="submit" > Apply</button>
                                        <?php }?>
                                    </form>

                                </div>     
                            </div>
                        </div>
                    </div>
                    <?php } ?>                
                </div>

                <div class="add-benefaction-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/donorAddBenefactions'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Benefactions</h5>
                    </button>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Function to handle delete confirmation
    function confirmDelete(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this benefaction. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with form submission
                const form = event.target.closest('form'); // Find the closest form element
                if (form) {
                    form.submit(); // Submit the form
                }
            }
        });
    }

    // Bind the confirmDelete function to form submission events
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form'); // Select all delete forms
        deleteForms.forEach(form => {
            form.addEventListener('submit', confirmDelete); // Attach confirmDelete to form submission
        });
    });
</script>



<?php require APPROOT.'/views/inc/footer.php'; ?>
