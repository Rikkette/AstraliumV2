<?php include "../include/header.php";
?>

<!-----------page regroupant toutes les illustrations avec Glightbox------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
</head>

<body>

    <script src="/public/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox();
    </script>

    <a href="image/Calendrier_01_Janvier.png" class="glightbox">
        <img src="image/Calendrier_01_Janvier.png" alt="calendrier_janvier" width="850" height="1090">
    </a>

</body>

</html>