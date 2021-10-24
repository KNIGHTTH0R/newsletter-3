<?php
use Newsletter\Controller\App;
?>
<div class="success-image" <?= App::$successImageVisibility ?>></div>
<div id="info">
    <h3 id="title"><?= App::$title; ?></h3>
    <p id="description"><?= App::$description; ?></p>
    <h3 id="notification">
        <?php
        if (isset(App::$message)) {
            echo App::$message;
        }
        ?>
    </h3>
</div>
<form id="form" method="POST" action="submit" <?= (App::$display_form)?"visible":"hidden"; ?>>
    <div id="submit-box">
        <input  type="text" 
                name="email" 
                placeholder="<?= App::$text_placeholder; ?>" 
                value="<?= isset(App::$email) ? htmlspecialchars(App::$email, ENT_QUOTES) : ''; ?>"
        >
        <button type="submit">Subscribe!</button>
    </div>
    <div id="terms-base">
        <input id="terms-accept" name="terms" type="checkbox">
        <label for="terms-accept">I agree to <a href="#">terms of service</a></label>
    </div>
</form>