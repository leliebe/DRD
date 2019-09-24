<?php
function parse_xml_file($file_name)
{
    $file_name = '../XML/' . $file_name;
    // echo $file_name;
    // include('./database/db_query.php');
    // $play_title = $_POST['play_title'];

    $xml = simplexml_load_file($file_name);
    // $title = $xml->teiHeader->fileDesc->titleStmt->title;
    // $author1 = $xml->teiHeader->fileDesc->titleStmt->author[0];
    // $author2 = $xml->teiHeader->fileDesc->titleStmt->author[1];
    // echo  "<h1>$title</h1></br>";
    $clvls = "->text->front->titlePage->";

    $titlepage1 = $xml->text->front->titlePage->docTitle->titlePart[0];
    $titlepage2 = $xml->text->front->titlePage->docTitle->titlePart[1];
    $titlepage3 = $xml->text->front->titlePage->docTitle->titlePart[1]->seg;
    $titlepage4 = $xml->text->front->titlePage->docTitle->titlePart[2];
    $titlepage5 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[0];
    $titlepage6 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[1];
    $titlepage7 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[2];
    $titlepage8 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[2]->persName->hi;
    $titlepage9 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[3];
    $byline = $xml->text->front->titlePage->byline . $xml->text->front->titlePage->byline->docAuthor->persName->hi;
    $imp1 =   $xml->text->front->titlePage->imprimatur->seg[0];
    $imp2 =   $xml->text->front->titlePage->imprimatur->seg[1];
    $imp3 =   $xml->text->front->titlePage->imprimatur->seg[2];
    $imp4 =   $xml->text->front->titlePage->imprimatur->seg[3];
    // $titlepage9 = $xml->text->front->titlePage->docTitle->titlePart[2]->seg[2]->seg;
    echo "<h1 class='tp1'>$titlepage1</h1>";
    echo "<h2 class='tp2'>$titlepage2</h2>";
    echo "<h1 class='tp3'>$titlepage3</h1><br>";
    echo "<h3 class='tp4'>$titlepage4 $titlepage5</h3>";
    // echo "<h3 class='tp4'>$titlepage4</h3>";
    // echo "<h3 class='tp5'>$titlepage5</h3><br>";

    echo "<h3 class='tp6'>$titlepage6<br></h3>";
    // echo "<h3 class='tp6'>$titlepage6</h3>";
    echo "<h3 class='tp7 imp-text-row'>$titlepage7</h3>";
    echo "<h3 class='tp8 imp-text-row'>$titlepage8</h3>";
    echo "<h3 class='tp9 imp-text-row'>$titlepage9</h3><br>";
    echo "<p class='text-author'>$byline</p>";
    echo "<p class='license'>$imp1 $imp2 $imp3 $imp4</p>";
    //echo "<p class='license'>$imp2</p>";
    //echo $imp3;
    // echo "<h3>Authors: $author1, &nbsp $author2</h3></br>";
    // echo "<h3>Author: $author2</h3></br>";

    // The following two statements can show all of the data but is not formatted
    // echo $xml->asXML();
    // var_dump($xml->asXML());
}
?>
