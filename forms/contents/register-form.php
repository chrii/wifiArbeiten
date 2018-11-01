<form action="" method="post" class="pure-form pure-form-stacked">
    <label for="vorname">Vorname</label>
    <input type="text" name="vorname" id="vorname">

    <label for="nachname">Nachname</label>
    <input type="text" name="nachname" id="nachname">

    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="passWord">Passwort</label>
    <input type="password" name="password" id="passWord">

    <label for="passWordConfirm">Passwort bestätigen</label>
    <input type="password" name="passwordconfirm" id="passWordConfirm">

    <label for="email">E-Mail</label>
    <input type="email" name="email" id="email">

    <fieldset>
        <legend>Geschlecht</legend>

        <label for="geschlechtW" class="pure-radio">
           <input type="radio" name="geschlecht" id="geschlechtW" value="female"> Weiblich
        </label>

        <label for="geschlechtM" class="pure-radio">
            <input type="radio" name="geschlecht" id="geschlechtM" value="male"> Männlich
        </label>
       
        <label for="other" class="pure-radio">
            <input type="radio" name="geschlecht" id="other" value="other"> Keine Angabe/Andere
        </label>
    </fieldset>

    <label for="tel">Telefon Nummer</label>
    <input type="tel" name="tel" id="tel">
    
    <label for="newsletter" class="pure-checkbox">
        <input type="checkbox" name="newsletter" id="newsletter" value="1">
         Newsletter bestellen
    </label>
    
    <label for="policy" class="pure-checkbox">
        <input type="checkbox" name="policy" id="policy" value="1"> Datenschutzbestimmungen aktzeptieren
    </label>

    <input type="submit" value="Senden" class="pure-button pure-button-primary">

    
</form>