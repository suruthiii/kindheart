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
        <div class="studentProfileCreation1-container">
            <div class="studentProfileCreation1-inner-container">
                <div class="studentProfileCreation1-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation1-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>1 of 6</span> 
                </div>
                <div class="studentProfileCreation1-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation1" method="GET">
                        <div class="studentProfileCreation1-inner-container-form-container-inputfeilds">   
                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal">
                                <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-inputgroup">
                                    <label for="firstName">First Name</label>
                                    <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-input1">
                                        <input class="inputt2" type="text" name="firstName" value="<?php echo $data['firstName']?>" required>
                                        <p class="error-message" for="password"><?php echo $data['firstName_err']?></p>
                                    </div>
                                </div>
                                <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-inputgroup">
                                    <label for="lastname">Last Name</label>
                                    <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-input1">
                                        <input class="inputt2" type="text" name="lastName" value="<?php echo $data['lastName']?>" required>
                                        <p class="error-message" for="password"><?php echo $data['lastName_err']?></p>
                                    </div>
                                </div>
                            </div>   

                            <label for="address">Address</label>
                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="address" value="<?php echo $data['address']?>"required>
                                <p class="error-message" for="password"><?php echo $data['address_err']?></p>
                            </div>

                            <label for="dob">Date Of Birth</label>
                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="date" name="dob" value="<?php echo $data['dob']?>" required>
                                <p class="error-message" for="password"><?php echo $data['dob_err']?></p>
                            </div>

                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal">
                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-inputgroup">
                                <label for="gender">Gender</label>
                                <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-selectbox">
                                    <select id="gender" name="gender" value="<?php echo $data['gender']?>">
                                        <option value="0" >
                                            Select Gender
                                        </option>
                                        <option value="1">
                                            Male
                                        </option>
                                        <option value="2">
                                            Female
                                        </option>
                                        <option value="3">
                                            Other
                                        </option>
                                    </select>  
                                </div>
                                <p class="error-message" for="password"><?php echo $data['gender_err']?></p>
                            </div>
                            <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-inputgroup">
                                <label for="studentType">Student Type</label>
                                <div class="studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-selectbox">
                                    <select id="studentType" name="studentType" value="<?php echo $data['studentType']?>">
                                        <option value="0" >
                                            Select Student Type
                                        </option>
                                        <option value="1">
                                            School Student
                                        </option>
                                        <option value="2">
                                            University Student
                                        </option>
                                    </select>  
                                </div>                                
                                <p class="error-message" for="password"><?php echo $data['studentType_err']?></p>
                            </div>

                        </div>
                        <div class="studentProfileCreation1-inner-container-form-container-buttons">
                            <button>Verify</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>

<script>
    // Select Box Customization
    var x, i, j, l, ll, selElmnt, a, b, c;

    /*look for any elements with the class "select-box":*/
    x = document.getElementsByClassName("studentProfileCreation1-inner-container-form-container-inputfeilds-2-input-horizontal-selectbox");
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
</html>