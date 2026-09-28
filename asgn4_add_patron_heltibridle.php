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
            $email = $_POST ['email']; 
            $city = $_POST ['city'];
            $birth = $_POST ['birthday'];
            $section = 'unknown';

            ?>

            <?php //Check for errors
             
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
                        print "Your Birth Year must be exactly four numbers<br>\n";
                        $errorflag = 'Y';
                    } else {
                        if ($birth > 2026) {
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
                For Admin Use Only: <span style="text-decoration: underline; color: blue;"><a href="asgn4_view_patrons_heltibridle.php">View Patrons</a></span>
            </p>
        </div>
    </main>
</body>
</html>