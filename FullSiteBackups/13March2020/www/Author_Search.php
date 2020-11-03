<?php include('head.php'); ?>
<?php include('author_select.php'); ?>
<div class="content Author_Search">
    <div class="auth-srch">

        <div class="auth-srch-title">
            <h1 class="auth-title">Browse by Author</h1>
        </div>

        <div class="auth-select">
            <select name="auth-sel" class="auth-sel" onchange="qry_plays(this);">
            <option value=" " selected="selected">Select Author</option>';
            <?php
                if (mysqli_num_rows($result2)!=0)
                {
                    while ($row = $result2->fetch_row())
                	{
                        $aname = "$row[1]" . ", " . "$row[0] \n";
                        echo "$aname\n";
                        echo '<option value="'.$aname.'">'.$aname.'</option>';
                	}
                    echo '</select>';
                }
            ?>
        </div>
        
        <!-- This div gets populated by drd.js -->
        <div class="auth-pl">
            <div class="auth-pl-auth-name">
                <h2 class="aplaname"></h2>
            </div>
            <div class="auth-pl-title">
                <h3 class="aplheading"></h3>
            </div>
            <div class="auth-pl-plays">
            </div>
        </div>

    </div>

    <div class="auth-play">
        <div class="auth-play-auth">
            <div class="auth-play-auth-name">
            </div>
            <div class="auth-play-auth-info">
            </div>
        </div>
        <div class="auth-play-play">
            <div class="auth-play-title">
                <h1 class="apltitle"></h1>
            </div>
            <div class="auth-play-text">
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
