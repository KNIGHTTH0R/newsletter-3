<?php
include('inc/header.php');
?>
<body>
    <a id="admin-link" href="admin">Admin</a> <!-- Demo -->
        
        <?php
        include('inc/navigation.php');
        ?>

        <div id="content">
            <div id="main-section">
                <div id="app">      <!-- App area starts -->
                    <call-to-action></call-to-action>
                </div>      <!-- App area ends -->

                <noscript>
                    <?php
                    include('inc/form.php');        // If JavaScript is disabled
                    ?>
                </noscript>

                <?php
                include('inc/footer.php');
                ?>
            </div>    
        </div>

    <script src="js/vendor/vue.global.prod.js"></script>     <!-- Import Vue 3 -->
    <script src="js/vendor/axios.min.js"></script>       <!-- HTTP client to POST from Vue -->
    <script src="js/vue-app.js"></script>      <!-- Import main app -->

</body>
</html>