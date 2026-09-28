<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Library - Registration Complete</title>
    <link rel="stylesheet" href="asgn4_style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="KingLibLogo.jpg" alt="King Library: Where information is at your command">
        </div>
    </header>

    <main>
        <div id="registration">
            <?php //Get form data

            $firstname = $_POST ['firstname'];
            $lastname = $_POST ['lastname'];
            $email = trim($_POST ['email']); // Rule 1: remove leading/trailing spaces
            $city = $_POST ['city'];
            $birth = $_POST ['birthday'];
            $section = 'unknown';

            ?>

            <?php //Check for errors

            function validateEmail($email) {

                // Rule 2: exactly one @
                if (substr_count($email, '@') != 1) {
                    print "Error: Email must contain exactly one @ symbol<br>\n";
                    return 'Y';
                }

                list($local, $domain) = explode('@', $email);

                // Rule 3: local part (before the @)
                if ($local == '') {
                    print "Error: Email must have something before the @<br>\n";
                    return 'Y';
                }
                if (strlen($local) > 32) {
                    print "Error: The part of your email before the @ cannot be longer than 32 characters<br>\n";
                    return 'Y';
                }
                if (!preg_match('/^[A-Za-z0-9.!#]+$/', $local)) {
                    print "Error: The part of your email before the @ may contain only letters, numbers, and . ! #<br>\n";
                    return 'Y';
                }

                // Rule 4: domain part (after the @)
                if ($domain == '') {
                    print "Error: Email must have a domain after the @<br>\n";
                    return 'Y';
                }
                if (strlen($domain) > 32) {
                    print "Error: The part of your email after the @ cannot be longer than 32 characters<br>\n";
                    return 'Y';
                }
                if (!preg_match('/^[A-Za-z0-9.-]+$/', $domain)) {
                    print "Error: The part of your email after the @ may contain only letters, numbers, dashes, and periods<br>\n";
                    return 'Y';
                }

                $lastDot = strrpos($domain, '.');
                if ($lastDot === false || $lastDot == 0) {
                    print "Error: Email domain must have a name and an ending, such as example.com<br>\n";
                    return 'Y';
                }

                $tld = substr($domain, $lastDot + 1);
                if (!preg_match('/^[A-Za-z]{2,}$/', $tld)) {
                    print "Error: Email must end with at least two letters after the last period, such as .com<br>\n";
                    return 'Y';
                }

                return 'N';   // passed every check
            }

            function errorChecks ($firstname,$lastname,$email,$city,$birth){
                
                $errorflag = 'N';

                if (empty($firstname)) {
                    print "Error: You must enter a First Name <br>\n";
                    $errorflag = 'Y';
                }

                if (empty($lastname)) {
                    print "Error: You must enter a Last Name<br>\n";
                    $errorflag = 'Y';
                }

                if (empty($email)) {
                    print "Error: You must enter your Email<br>\n";
                    $errorflag = 'Y';
                } else {
                    if (validateEmail($email) == 'Y') {
                        $errorflag = 'Y';
                    }
                }

                if (empty($birth)) {
                    print "Error: You must enter your Birth Year<br>\n";
                    $errorflag = 'Y';
                } else {
                    if (!is_numeric($birth)) {
                        print "Error: Birth Year must be numeric<br>\n";
                        $errorflag = 'Y';
                    } else {
                        if (strlen($birth) !=4) {
                            print "Error: Your Birth Year must be exactly four numbers<br>\n";
                            $errorflag = 'Y';
                        } else {
                            if ($birth > date('Y')) {
                                print "Error: Birth Year cannot be later than this year<br>\n";
                                $errorflag = 'Y';
                            }
                        }
                    }
                }

                if (empty($city)) {
                    print "Error: You must select a City<br>\n";
                    $errorflag = 'Y';
                }

                return $errorflag;
            }

            $errorflag = errorChecks($firstname,$lastname,$email,$city,$birth);

            if ($errorflag == 'Y') {
                print "<p>Go BACK and make corrections</p>\n";
                print "</div></body></html>";
                exit;
            }

            ?>

            <?php //Determine section by age

            $cur_year = date('Y');
            $age = $cur_year - $birth;

            if ($age < 16) {
                $section = 'Children';
            } elseif ($age > 54) {
                $section = 'Senior';
            } else {
                $section = 'Adult';
            }

            ?>

            <h1 id="thanks">Thank You for Registering!</h1>

            <?php //Return registration info

            print "<p>Name: ".$firstname.' '.$lastname."</p>\n";
            print "<p>Email: $email</p>\n";
            print "<p>City: $city</p>\n";
            print "<p>Section: $section</p>\n";

            ?>

            <?php //Save data to file

            $filename = 'patrons.txt';
            $fp = fopen($filename, 'a');

            $patron_data = $lastname.'|'.$firstname.'|'.$email.'|'.$city.'|'.$birth.'|'."\n";

            fwrite($fp, $patron_data);
            fclose($fp);

            ?>

            <p>
                For Admin Use Only: <span style="text-decoration: underline; color: blue;"><a href="asgn4_view_patrons_AI_heltibridle.php">View Patrons</a></span>
            </p>
        </div>
    </main>
</body>
</html>