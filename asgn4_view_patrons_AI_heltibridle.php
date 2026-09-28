<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Library - View Patrons</title>
    <link rel="stylesheet" href="asgn4_style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="KingLibLogo.jpg" alt="King Library: Where information is at your command">
        </div>
    </header>
    <main>
        <div class="patron-view"> 
            <h1>View Patrons</h1>

            <table border = '1'>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Birth Year</th>
                </tr>

                <?php
                $filename = 'patrons.txt';
                $patrons = []; // will hold one entry per patron

                // Step 1: Read every line into the array
                $fp = fopen($filename, 'r');
                while (true) {
                    $line = fgets($fp);
                    if (feof($fp)) {
                        break;
                    }
                    $patrons[] = explode('|', $line); // [0]=last, [1]=first, [2]=email, [3]=city, [4]=birth
                }
                fclose($fp);

                // Step 2: Sort by last name, then first name
                usort($patrons, function($a, $b) {
                    $result = strcasecmp($a[0], $b[0]); // compare last names
                    if ($result == 0) {
                        $result = strcasecmp($a[1], $b[1]); // same last name, so compare first names
                    }
                    return $result;
                });

                // Step 3: Build the table rows from the sorted array
                $display = "";
                $cntr = 0;

                foreach ($patrons as $patron) {
                    list($lastname, $firstname, $email, $city, $birth) = $patron;

                    $cntr++;
                    if ($cntr % 2 == 0) {
                        $style = "style='background-color: #FFFFCC;'";
                    } else {
                        $style = "style='background-color: white;'";
                    }

                    $display .="<tr $style>";
                        $display .= "<td>".$lastname."</td>";
                        $display .= "<td>".$firstname."</td>";
                        $display .= "<td>".$email."</td>";
                        $display .= "<td>".$city."</td>";
                        $display .= "<td>".$birth."</td>";
                    $display .="</tr>\n";
                }

                print $display;
                ?>
            </table>
        </div>
    </main>
</body>
</html>