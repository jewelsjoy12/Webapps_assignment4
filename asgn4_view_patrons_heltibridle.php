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
        <div id="registration"> 
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
                $display = "";
                $cntr = 0;
                $filename = 'patrons.txt';
                $fp = fopen($filename, 'r');
                while(true) {
                    $line = fgets($fp);
                    if (feof($fp)) {
                        break;
                    }
                    $cntr++;
                    $even_lines = $cntr % 2;
                    if ($even_lines == 0) {
                        $style = "style='background-color: #FFFFCC;'";
                    } else {
                        $style = "style='background-color: white;'";
                    }
                    list($lastname, $firstname, $email, $city, $birth) = explode('|', $line);

                    $display .="<tr $style>";
                        $display .= "<td>".$lastname."</td>";
                        $display .= "<td>".$firstname."</td>";
                        $display .= "<td>".$email."</td>";
                        $display .= "<td>".$city."</td>";
                        $display .= "<td>".$birth."</td>";
                    $display .="</tr>\n";

                }
                fclose($fp);

                print $display;
                ?>
            </table>
        </div>
    </main>
</body>
</html>