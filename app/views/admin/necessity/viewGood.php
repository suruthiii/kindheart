<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/necessity/physicalgood">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Necessity</h3>
            <p style="margin-left: 10px">View information about the necessities of donees</p>
            
            <div class="necessity-info">
                <table>
                    <?php foreach($data['necessity_details'] as $key => $value){
                        if ($key == 'doneeID'){continue;} ?>
                        
                        <tr class="necessity-data">
                            <th width="30%"><?php echo $key?></th>
                            <td width="70%"><?php echo $value?></td>
                        </tr>
                    <?php }?>

                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>" class="view-donation-btn">
                    <!-- <button type="submit" class="view-donation-btn" > -->
                        View Donee Profile
                    <!-- </button> -->
                </a>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
