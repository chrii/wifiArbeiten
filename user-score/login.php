
        <h2>Login</h2>
            <form action="" method="post" class="pure-form pure-form-stacked">
                <label for="userName">Username</label>
                <input type="text" name="username" id="userName">

                <label for="passWord">Passwort</label>
                <input type="password" name="password" id="passWord">
                <p class="error"><?php
                    foreach ($errors AS $error){
                        echo $error;
                    }
                    ?>
                </p>
                <input type="submit" value="Anmelden" class="pure-button pure-button-primary">
            </form>
        <a href="password-forgotten.php">Passwort vergessen?</a>


