<?php
  function menu_bar()
  {
    $items = array("Home", "Search", "Full Play Texts", "About", "Contact");
      // "<h1>Digital Restoration Drama</h1>"
      foreach ($items as $item)
      {
          if (isset($_GET['page']) && $_GET['page'] == $item)
          {
              echo '<a href="?page=' . $item . '" class="active"> ' . $item . '</a></br>';
              $activePage = "DRD_" . $item . ".php";
          }
          else
          {
              echo '<a href="?page=' . $item . '"> ' . $item . '</a></br>';
          }
      }
      if (isset($activePage))
      {
          include $activePage;
      }
      else
      {
          include "DRD_Home.php";
      }

    }
?>
