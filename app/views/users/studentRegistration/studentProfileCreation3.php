<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registration_Login.css" />
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentProfileCreation3-container">
            <div class="studentProfileCreation3-inner-container">
                <div class="studentProfileCreation3-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation3-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>3 of 7</span> 
                </div>
                <div class="studentProfileCreation3-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation3" method="GET">
                        <div class="studentProfileCreation3-inner-container-form-container-inputfeilds">   

                            <label for="careType">Select Parent/Guardian</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-selectbox">
                                <select id="careType" name="careType" value="<?php echo $data['careType']?>" required>
                                    <option value="0" >
                                        Select Parent / Guardian
                                    </option>
                                    <option value="1">
                                        Father
                                    </option>
                                    <option value="2">
                                        Mother
                                    </option>
                                    <option value="3">
                                        Guardian
                                    </option>
                                </select>  
                            </div>                            
                            <p class="error-message" for="careType"><?php echo $data['careType_err']?></p>

                            <label for="careName">Parent/Guardian Name</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careName" value="<?php echo $data['careName']?>" required>
                                <p class="error-message" for="careName"><?php echo $data['careName_err']?></p>
                            </div>

                            <label for="careOccu">Parent/Guardian Occupation</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careOccu" value="<?php echo $data['careOccu']?>" required>
                                <p class="error-message" for="careOccu"><?php echo $data['careOccu_err']?></p>
                            </div>

                            <label for="careRealat">Relationship to the Student</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careRealat" id="careRealat" value="<?php echo $data['careRealat']?>">
                                <!-- <p class="error-message" for="careRealat"><?php echo $data['careRealat_err']?></p> -->
                            </div>

                        </div>
                        <div class="studentProfileCreation3-inner-container-form-container-buttons">
                            <button>Next</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>

    <script>
    // Select Box Customization
    var x, i, j, l, ll, selElmnt, a, b, c;

    /*look for any elements with the class "select-box":*/
    x = document.getElementsByClassName("studentProfileCreation3-inner-container-form-container-inputfeilds-selectbox");
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
                        
                        // Check if "Guardian" is selected
                        if (this.innerHTML.trim() === "Guardian") {
                            // Disable the "Relationship to the Student" input field
                            document.getElementById("careRealat").disabled = false;
                        } else {
                            // Enable the "Relationship to the Student" input field
                            document.getElementById("careRealat").disabled = true;
                        }
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
    
</body>
</html>