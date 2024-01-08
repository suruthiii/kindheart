<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "admins";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Admins</h3>
            <p style="margin-left: 10px">View the list of admins</p>
            
            <div class="report-list">
                <div class="report-cards">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 2 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                     <!-- Card 3 -->
                     <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 4 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                     <!-- Card 5 -->
                     <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 6 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                    
                    <!-- Card 7 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 8 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                </div>
            </div>
            
            <!-- <div class="add-report-btn-container">
                <button class="add-report-btn">
                    <span class="plus">+</span> 
                    &nbsp;Add Reports
                </button>
            </div> -->

            <div class="right-content">
                
                <h3 style="margin-top: 30px; text-align:center; margin-left: 0;">Generate Reports</h3>
                
                <form class="add-report-form">
                    <label for="report-name">Report Name</label><br>
                    <input type="text" id="report-name" name="report-name"><br><br>

                    <label for="criteria">Criteria</label><br>
                    <input type="text" id="criteria" name="criteria"><br><br>

                    <label for="sdate">Start Date</label><br>
                    <input type="date" id="sdate" name="sdate"><br><br>

                    <label for="edate">End Date</label><br>
                    <input type="date" id="edate" name="edate"><br><br>

                    <!-- <input type="submit" value="Generate"> -->
                    <div class="gen-area">
                        <p class="text-warning" id="message"></p>
                        <button type="button" class="gen-btn" id="gen" onclick="generatePDF()">Generate</button>
                        <button class="view-btn" id="view" onclick="viewPDF()" style="display: none;">View</button>
                        <button class="save-btn" id="down" onclick="saveBlob()" style="display: none;">Save</button>
                    </div>
                </form>

                
                
            </div>
            
        </div>
    </section>
</main>

<script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>
<script>
    //pdf generate code
    //Generate pdf
    var pdfObject; //outputType: jsPDFInvoiceTemplate.OutputType.Blob,

    var props = {
        outputType: jsPDFInvoiceTemplate.OutputType.Blob,
        returnJsPDFDocObject: true,
        fileName: "Invoice 2021",
        orientationLandscape: false,
        compress: true,
        logo: {
            src: "<?php echo URLROOT ?>/img/bell-1.png",
            type: 'PNG', //optional, when src= data:uri (nodejs case)
            width: 53.33, //aspect ratio = width/height
            height: 26.66,
            margin: {
                top: 0, //negative or positive num, from the current position
                left: 0 //negative or positive num, from the current position
            }
        },
        
        business: {
            name: "Kind Heart",
            address: "Sri Lanka",
            phone: "0775554487",
            email: "kindheart@gmail.com",
            website: "www.kindheart.lk",
        },
        invoice: {
            header: [
                {
                    title: "#",
                    style: {
                        width: 10
                    }
                },
                {
                    title: "Title",
                    style: {
                        width: 30
                    }
                },
                {
                    title: "Description",
                    style: {
                        width: 80
                    }
                },
                { title: "Price" },
                { title: "Quantity" },
                { title: "Unit" },
                { title: "Total" }
            ],
            table: Array.from(Array(100), (item, index) => ([
                index + 1,
                "There are many variations ",
                "Lorem Ipsum is simply dummy text dummy text ",
                200.5,
                4.5,
                "m2",
                400.5
            ])),
            additionalRows: [{
                col1: 'Total:',
                col2: '145,250.50',
                col3: 'ALL',
                style: {
                    fontSize: 14 //optional, default 12
                }
            },
                {
                    col1: 'VAT:',
                    col2: '20',
                    col3: '%',
                    style: {
                        fontSize: 10 //optional, default 12
                    }
                },
                {
                    col1: 'SubTotal:',
                    col2: '116,199.90',
                    col3: 'ALL',
                    style: {
                        fontSize: 10 //optional, default 12
                    }
                }],
        },
        footer: {
            text: "The invoice is created on a computer and is valid without the signature and stamp.",
        },
        pageEnable: true,
        pageLabel: "Page ",
    };

    /* generate pdf */
    function generatePDF() {
        pdfObject = jsPDFInvoiceTemplate.default(props);
        console.log("Object generated: ", pdfObject);
        document.getElementById('message').textContent = 'Your report is generated!';
        document.getElementById('gen').style.display = 'none';
        document.getElementById('view').style.display = 'inline-block';
        document.getElementById('down').style.display = 'inline-block';
    }

    /* view pdf */
    function viewPDF() {
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        var fileURL = URL.createObjectURL(pdfObject.blob);
        window.open(fileURL, '_blank');
    }

    /* download pdf */
    function saveBlob() {
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        const fileURL = URL.createObjectURL(pdfObject.blob);
        const link = document.createElement('a');
        link.href = fileURL;
        link.download = "Invoice" + new Date() + ".pdf";
        link.click();
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>