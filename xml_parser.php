<?php
function parse_xml_file($file_name)
{
    $file_name = '../XML/' . $file_name;
    // echo $file_name;
    // include('./database/db_query.php');
    // $play_title = $_POST['play_title'];

    $xml = simplexml_load_file($file_name) or die("Error: Cannot create object");

    // $title = $xml->teiHeader->fileDesc->titleStmt->title;
    // $author1 = $xml->teiHeader->fileDesc->titleStmt->author[0];
    // $author2 = $xml->teiHeader->fileDesc->titleStmt->author[1];
    // echo  "<h1>$title</h1></br>";
    $count = 1;
    $wline = "";
    echo "<div class='titlepart'>";
    foreach ($xml->text->front->titlePage->docTitle->titlePart as $titlepart)
    {
        // $count++;
        foreach($titlepart->line as $tpline)
        {
            echo "<p class='tp$count'>$tpline</p>";
            foreach($tpline->seg as $tpseg)
            {
                $wline .= $tpseg;
                if ($tpseg->persName->hi)
                {
                    $wline .= $tpseg->persName->hi;
                }
            }
            echo "<p class='tp$count'>$wline</p>";
            $count++;
        }
        echo "<p class='tp$count'>$titlepart</p>";
        $count++;
    }
    echo "</div>";//close titlepart


    echo "<div class='byline'>";
    $byline = $xml->text->front->titlePage->byline . $xml->text->front->titlePage->byline->docAuthor->persName->hi;
    echo "<p class='text-author'>$byline</p>";
    echo "</div>";//close byline

    echo "<div class='hrimp'>";
    echo "<hr/>";
    echo "</div>";

    echo "<div class='imprimatur'>";
    $imp1 = $xml->text->front->titlePage->imprimatur->seg[0];
    $imp2 = $xml->text->front->titlePage->imprimatur->seg[1] .
            $xml->text->front->titlePage->imprimatur->seg[2] .
            $xml->text->front->titlePage->imprimatur->seg[3];

    echo "<p class='license'>$imp1</p>";
    echo "<p class='licdate'>$imp2</p>";
    echo "</div>";

    echo "<div class='hrimp'>";
    echo "<hr/>";
    echo "</div>";

    echo "<div class='docimprint'>";
    $placename = $xml->text->front->titlePage->docImprint->placeName->hi;
    echo "<p class='doc-plname'>$placename</p>";

    $di_line_ct = 1;
    foreach($xml->text->front->titlePage->docImprint->line as $diline)
    {
        $di_line = $diline;
        foreach($diline->seg as $diseg)
        {
            $di_line .= $diseg;
            if ($diseg->persName->hi)
            {
                $di_line .= $diseg->persName->hi;
            }
            if ($diseg->placeName->hi)
            {
                $di_line .= $diseg->placeName->hi;
            }
            if ($diseg->date)
            {
                $di_line .= $diseg->date;
            }
        }
        if ($di_line_ct == 1)
        {
            $di_first_line = $di_line;
            $di_line = "";
        }
        else
        {
            $di_second_line = $di_line;
        }
        $di_line_ct++;
    }
    echo "<p class='di-text1'>$di_first_line</p>";
    echo "<p class='di-text1'>$di_second_line</p>";

    echo "</div>";//close docimprint

    echo "<div class='hrcl'>";
    echo "<hr/>";
    echo "</div>";

    echo "<div class='castList'>";
    echo "<div class='castListHead'>";
    $casthead = $xml->text->front->castList->head;
    echo "<p class='clhead'>$casthead</p>";
    echo "</div>";
    $cg1cnt = 1;
    $cg2cnt = 1;
    $roleGrpCnt = 1;
    $divCntItem = 1;
    $segCnt = 1;
    // $CG2 = $xml->text->front->castList->castGroup->castGroup->castItem;
    // printf("%s has got %d children.\n", $CG2, $CG2->count());
    foreach($xml->text->front->castList->castGroup as $castGroup1)
    {
        echo "<div class='outerCG$cg1cnt'>";

        echo "<div class='outerCGhead$cg1cnt'>";
        if ($castGroup1->head)
        {
            $cg1h = $castGroup1->head;
            echo "<p class='cghead'>$cg1h</p>";
        }
        echo "</div>";

        foreach($castGroup1->castGroup as $castGroup2)
        {
            echo "<div class='innerCG$cg2cnt'>";
            foreach($castGroup2->castItem as $castItem)
            {
                if ($divCntItem == 1)
                {
                    echo "<div class='$cg1h$roleGrpCnt'>";

                }
                if ($castItem->role->name)
                {
                    $cItem = $castItem->role->name;
                    $castItem .=  "<p class='ciname'>$cItem</p>";
                    echo $castItem;
                }
                if ($castItem->roleDesc != null)
                {
                    $divCntItem = 0;
                    echo "</div>";
                }

                if ($castItem->roleDesc->hi)
                {
                    $rDesc = $castItem->roleDesc->hi;
                    $roleDesc = "<p class='rdesc1'>$rDesc</p>";
                    if ($castItem->roleDesc->seg)
                    {
                        $rDesc = $castItem->roleDesc->seg;
                        $roleDesc .= "<p class='rdesc2'>$rDesc</p>";
                    }
                    if ($castItem->roleDesc->seg[1]->hi)
                    {
                        $rDesc = $castItem->roleDesc->seg[1]->hi;
                        $roleDesc .= "<p class='rdesc3'>$rDesc</p>";
                    }
                    $roleDesc = "<div class='roleDesc$roleGrpCnt'>$roleDesc</div><br>";
                    echo $roleDesc;
                }
                if ($castItem->seg)
                {
                    foreach($castItem->seg as $ciSeg)
                    {
                        // echo $ciSeg;
                        // $ciSeg = $castItem->seg[$segCnt];
                        $castSeg .= "<p class='seg$segCnt'>$ciSeg</p>";
                        $segCnt++;
                    }
                    $castSeg = "<div class='segDiv$roleGrpCnt'>$castSeg</div><br>";
                    echo $castSeg;
                }
                $divCntItem++;
                $roleGrpCnt++;
            }
            $cg2cnt++;
            echo "</div>";
        }
        $cg1cnt++;
        echo "</div>";
    }
    echo "</div>";

    echo "<div class='hrset'>";
    echo "<hr/>";
    echo "</div>";

    echo "<div class='set'>";

    $set1 = $xml->text->front->set->seg[0];
    $set2 = $xml->text->front->set->hi;
    $set3 = $xml->text->front->set->seg[1];

    $set = "<p class='set1'>$set1</p>";
    $set .= "<p class='set2'>$set2</p>";
    $set .= "<p class='rdesc1'>$set3</p>";

    echo $set;


    echo "</div>";//close set

    echo "<div class='hrsalute'>";
    echo "<hr/>";
    echo "</div>";

    echo "<div class='salute'>";

    $saltitle = $xml->text->front->salute->title->p;

    $saltitle = "<p class='set1'>$saltitle</p>";

    echo $saltitle;

    foreach ($xml->text->front->salute->p as $salute)
    {
        if ($salute->persName)
        {
            $salpersName = $salute->persName;
            $salpersName = "<p class='salpersName'>$salpersName</p>";
        }
        foreach ($salute->seg as $salSeg)
        {
            $salText .= $salSeg;
            if ($salSeg->hi)
            {
                $salText .= "<i>$salSeg->hi</i>";
            }
        }
    }
    echo "<div class='spName'>";
    echo $salpersName;
    echo "</div>";//close spName

    echo "<div class='salTextDiv'>";
    echo "<p class='salText'>";
    echo $salText;
    echo "</p>";
    echo "</div>";//close salTextDiv

    echo "</div>";//close salute


    //
    //Prolog goes HERE
    //
    // echo "<div class='hrpbody'>";
    // echo "<hr/>";
    // echo "</div>";
    $stagecnt = 0;
    foreach ($xml->text->body as $playBody)
    {
        foreach ($playBody->div as $pBodyDiv)
        {
            foreach ($pBodyDiv->head as $pBDHead)
            {
                foreach ($pBDHead->hi as $pBDHeadHi)
                {
                    echo "<div class='hract'>";
                    echo "<hr/>";
                    echo "</div>";

                    $act = "<div class='act'><h1>$pBDHeadHi</h1></div>";
                    echo $act;
                    foreach ($pBDHead->stage as $pBDHeadStage)
                    {
                        $stagecnt++;
                        echo "<div class='stagegrp$stagecnt'>";
                        foreach ($pBDHeadStage->seg as $pBDHStageSeg)
                        {
                            foreach ($pBDHStageSeg->seg as $pBDHStageSeg2)
                            {
                                //$StageS2 = $pBDHStageSeg2;
                                $StageSeg2 .= $pBDHStageSeg2;
                                foreach ($pBDHStageSeg2->name as $pBDHStageName)
                                {
                                    // $stageNm = $pBDHStageName;

                                    $StageName = "<i>$pBDHStageName</i>";
                                    $StageSeg2 .= $StageName;
                                }
                                foreach ($pBDHStageSeg2->hi as $pBDHStageHi)
                                {
                                    // $stgHi = $pBDHStageHi;
                                    $StageHi = "<i>$pBDHStageHi</i>";
                                    $StageSeg2 .= $StageHi;
                                }
                            }
                        }
                        echo "<p class='stage'>$StageSeg2</p>";
                        $StageSeg2 = "";
                        echo "</div>";
                    }
                }

            }
            foreach ($pBodyDiv->sp as $pBSp)
            {
                foreach ($pBSp->stage as $pBSpStage)
                {
                    echo "<div class='innerstage'>";
                    echo $pBSpStage;
                    foreach ($pBSpStage->seg as $pBSpStageSeg)
                    {
                        echo $pBSpStageSeg;
                        foreach ($pBSpStageSeg->seg as $pBSpStageSegSeg)
                        {
                            echo $pBSpStageSegSeg;
                            foreach ($pBSpStageSegSeg->name as $pBSpStageSSName)
                            {
                                echo "<i>$pBSpStageSSName</i>";

                            }
                            foreach ($pBSpStageSegSeg->hi as $pBSpStageSSHi)
                            {
                                echo "<i>$pBSpStageSSHi</i>";

                            }

                        }
                        foreach ($pBSpStageSeg->name as $pBSpStageSegName)
                        {
                            echo "<i>$pBSpStageSegName</i>";

                        }

                    }
                    echo "</div>";
                }

                foreach ($pBSp->speaker as $pBSpSpeaker)
                {
                    echo "<div class='speaker'><i>$pBSpSpeaker->name</i></div>";
                }

                echo "<div class='spText'>";
                foreach ($pBSp->l as $pBSpLine)
                {
                    if ($pBSpLine->seg->count() == 0 && $pBSpLine->stage->count() == 0)
                    {
                        echo "$pBSpLine<br>";
                    }
                    foreach ($pBSpLine->seg as $pBSpLineSeg)
                    {
                        $spLs = $pBSpLineSeg;
                        $lineSeg .= $spLs;
                        foreach ($pBSpLineSeg->name as $pBSpLineSegName)
                        {
                            $lineSeg .= $pBSpLineSegName;

                        }
                        foreach ($pBSpLineSeg->hi as $pBSpLineSegHi)
                        {
                            $lineSeg .= $pBSpLineSegHi;
                        }
                    }
                    if ($lineSeg != "" && $lineSeg != null)
                    {
                        echo "$lineSeg<br>";
                    }
                    $lineSeg = "";
                    foreach ($pBSpLine->stage as $pBSpLineStage)
                    {
                        $stageDir = $pBSpLineStage;
                        foreach ($pBSpLineStage->seg as $pBSpLStageSeg)
                        {
                            $stageDir .= $pBSpLStageSeg;
                        }
                        echo "<div class='innerstage'>$stageDir</div>";
                    }

                }
                echo "</div>";

            }

        }
    }


}//end of function parse_xml_file
?>
