<?php
    $xml = simplexml_load_file('./XML/Ravenscroft_Titus.xml');
    $title = $xml->teiHeader->fileDesc->titleStmt->title;
    $author1 = $xml->teiHeader->fileDesc->titleStmt->author[0];
    $author2 = $xml->teiHeader->fileDesc->titleStmt->author[1];
    echo "<h1>$title</h1></br>";
    echo "<h3>Authors: $author1, &nbsp $author2</h3></br>";
    // echo "<h3>Author: $author2</h3></br>";
?>
<pre> <?php print_r($xml); ?> </pre>
