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
                $filename = 'patrons.txt';
                $fp = fopen($filename, 'a');

                fclose($fp);
            ?>
        </div>
    </main>
</body>
</html>