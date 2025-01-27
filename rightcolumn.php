<!-- Begin Right Column -->
<div id="rightcolumn">
    <div class="clear">
        <?php
        // Check if error occurred
        if (!empty($_GET['error'])) {
            echo $_GET['error'];
            die();
        }

        // Check if parameter 'page' is set
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
            
            if($page == "Welcome")
            {
                include "./Welcome.php";
            }
        }
        ?>
    </div>
</div>
<!-- End Right Column -->
