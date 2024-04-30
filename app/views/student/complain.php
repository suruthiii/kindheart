<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donors";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <a href="<?php echo URLROOT ?>/student/donors">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
                

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add a complain to this donor</h3>
                </div>

              
                <div class="application-form-data">
                    <form class="add-form" method="POST" action="<?php echo URLROOT ?>/student/addComplain">

                        <label for="reason">Reason</label><br>
                        <input type="textarea" id="reason" name="reason" required><br><br>

                        <input type="text" name="donorID" id="donorID" hidden value="<?php echo $data["donorID"]?>" />


                        <input type="submit" value="Complain">
                    </form>

                </div>
                




            </div>
            

            <!-- right side bar for success story/ choose or add necessity -->
            
                </div> 

        </div>
    </section>
</main>


<?php require APPROOT.'/views/inc/footer.php'; ?>