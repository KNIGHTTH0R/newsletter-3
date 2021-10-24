<?php
include('inc/header.php');
require('vendor/autoload.php');
use Newsletter\Controller\App;
?>
        <div id="content">

            <h1 class="error-message"><?= App::$error_message; ?></h1>

            <div id="main-section">

                <?php
                include('inc/footer.php');
                ?>

            </div>    
        </div>
    </main>
    
    <div id="picture"></div>    

</body>
</html>