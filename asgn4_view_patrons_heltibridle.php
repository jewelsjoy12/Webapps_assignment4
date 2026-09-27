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
            }
            fclose($fp);
            ?>
        </div>
    </main>
</body>
</html>