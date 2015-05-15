<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia | Mortgage Calculator</title>
        <meta name="description" content="Mustafa Zia - Mortgage Calculator">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta property="og:type"  content="website" />
        <meta property="og:url"   content="<?php echo "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" />
        <meta property="og:title" content="Mustafa Zia | Mortgage Calculator" />
        <meta property="og:image" content="http://mustafazia.com/img/facebook.jpg" />
        <meta property="og:description" content="Mustafa Zia is an award wining, top producer realtor serving Mississauga, Brampton, Milton, Oakville and Toronto. Mustafa helps people buying or selling a home, investing in real estate or simply providing helpful advice on real estate matters." />        

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" href="css/basic_page.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>     
    </head>
    <body id="Calculator-Page" class="basic-page">

        <?php include 'header.php';?>

        <div id="TopBanner">
            <div class="inner-wrapper">
                <h1>Mortgage Calculator</h1>
            </div>
            <div class="blind"></div>
        </div>

        <section id="ContentBody">
            <div class="inner-wrapper">
                <div class="smpc-div">
                    <div class="left">
                        <form name=mortgagecalc method=POST>
                            <p>How much will you be borrowing?<br>
                            <input type=text onkeypress="return validNumber(event)" name=loan size=10> <span class="smpc-error" id="loanError"></span></p>
                            <p>What will be the term of this mortgage (in years)?<br>
                            <input type=text onkeypress="return validNumber(event)" name=years size=5> <span class="smpc-error" id="yearsError"></span></p>
                            <p>What will be the interest rate?<br>
                            <input type=text onkeypress="return validNumber(event)" name=rate size=5> % <span class="smpc-error" id="rateError"></span></p>
                            <input type=button class="btn-round" onClick="return myPayment()" value=Calculate>
                            <input type=button class="btn-round" onClick="return myPaymentReset()" value=Reset>
                        </form>
                    </div>
                    <div class="right">
                        <p class="smpc-monthlypayment" id="monthlyPayment"><small>Instructions: Enter numbers and decimal points. No commas or other characters.</small></p>
                        <small class="smpc-friendlyreminder" id="friendlyReminder">Results received from this calculator are designed for comparative purposes only, and accuracy is not guaranteed.<br>Please <a href="contact.php">contact us</a> to address your mortgage needs.</small>
                    </div>
                </div>                
            </div>            
        </section>
         
        <?php include 'footer.php';?>

        <script src="js/main.js"></script>

        <script type="text/javascript">

            /*!
            * Raving Roo - Simple Mortgage Payment Calculator (SMPC) v1.0
            * Copyright 2014 by David K. Sutton
            *
            * You are free to use this script on your website.
            * While not required, it would be much appreciated if you could link back to http://ravingroo.com
            */

            function validNumber(fieldinput){
            var unicode=fieldinput.charCode? fieldinput.charCode : fieldinput.keyCode;
            if ((unicode!=8) && (unicode!=46)) { //if the key isn't the backspace key (which we should allow)
            if (unicode<48||unicode>57) //if not a number
            return false; //disable key press
            }
            }

            function myPayment()
            {
            // Reset error messages to blank
            document.getElementById('loanError').innerHTML = '';
            document.getElementById('yearsError').innerHTML = '';
            document.getElementById('rateError').innerHTML = '';

            // Form validation checking
            if ((document.mortgagecalc.loan.value === null) || (document.mortgagecalc.loan.value.length === 0) || (isNaN(document.mortgagecalc.loan.value) === true))
            {
            document.getElementById('monthlyPayment').innerHTML = 'Please enter the missing information.';
            document.getElementById('loanError').innerHTML = 'Numeric value required. Example: 500000';
            } else if ((document.mortgagecalc.years.value === null) || (document.mortgagecalc.years.value.length === 0) || (isNaN(document.mortgagecalc.years.value) === true))
            {
            document.getElementById('monthlyPayment').innerHTML = 'Please enter the missing information.';
            document.getElementById('yearsError').innerHTML = 'Numeric value required. Example: 25';
            } else if ((document.mortgagecalc.rate.value === null) || (document.mortgagecalc.rate.value.length === 0) || (isNaN(document.mortgagecalc.rate.value) === true))
            {
            document.getElementById('monthlyPayment').innerHTML = 'Please enter the missing information.';
            document.getElementById('rateError').innerHTML = 'Numeric value required. Example: 5.25';
            } else
            {
            // Set variables from form data
            var loanprincipal = document.mortgagecalc.loan.value;
            var months = document.mortgagecalc.years.value * 12;
            var interest = document.mortgagecalc.rate.value / 1200;

            // Calculate mortgage payment and display result
            document.getElementById('monthlyPayment').innerHTML = 'Your monthly mortgage payment will be: ' + '<strong>$' + (loanprincipal * interest / (1 - (Math.pow(1/(1 + interest), months)))).toFixed(2)+'</strong>.';
            document.getElementById('friendlyReminder').style.display = 'block';
            }

            // payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))

            }

            function myPaymentReset()
            {
            // Reset everything to default/null/blank
            document.getElementById('monthlyPayment').innerHTML = '<small>Instructions: Enter numbers and decimal points. No commas or other characters.</small>';
            document.getElementById('friendlyReminder').style.display = 'none';
            document.getElementById('loanError').innerHTML = '';
            document.getElementById('yearsError').innerHTML = '';
            document.getElementById('rateError').innerHTML = '';
            document.mortgagecalc.loan.value = null;
            document.mortgagecalc.years.value = null;
            document.mortgagecalc.rate.value = null;
            }

        </script>


    </body>
</html>
