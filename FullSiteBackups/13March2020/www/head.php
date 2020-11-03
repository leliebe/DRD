<!DOCTYPE html>
<html>
  <head>
    <title><?php echo($title); ?></title>
    <meta name="description" content="Information on Drama Plays from the Restoration Period - A Digital Humanities Site">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="./css/navbar.css" rel="stylesheet" type="text/css">
    <!-- <link href="./css/test.css" rel="stylesheet" type="text/css"> -->
    <link href="./css/DRD_CSS.css" rel="stylesheet" type="text/css">
    <script src="./javascript/jquery-3.4.1/jquery-3.4.1.js"></script>
    <script src="./javascript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="./javascript/drd.js"></script>
  </head>
  <body>
    <div class="drd-page">
        <div class="title-div">
          <h1 class="title">Digital Restoration Drama</h1>
        </div>
        <?php include('navbar.php'); ?>
<!-- By putting the opening body tag here the navbar can be included on every page
without having to duplicate the include line.  the closing body tag is in footer.php
which is included as the last line on every page.-->
