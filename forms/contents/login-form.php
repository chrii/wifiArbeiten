<?php
    foreach($errors as $error) {
        echo $error;
    }
?>
<form action="" method="post" class="pure-form pure-form-stacked">
    <!-- For bezieht sich auf die id des Formularfeldes -->
    <label for="userName">Name</label>
    <input type="text" name="username" id="userName">

    <label for="passWord">Passwort</label>
    <input type="password" name="password" id="passWord">

    <!-- Emmet: input:submit.pure-button.pure-button-primary -->
    <input type="submit" value="Senden" class="pure-button pure-button-primary">
</form>