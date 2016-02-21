<div id="form_login">
    <?php
    if( isset($_GET['p2']) && $_GET['p2'] == 'desconectar' || \core\Usuario::$login == 'anonimo') { ?>
        <form name='form_login' class="navbar-form navbar-right" role="form" method='post' action='<?php echo \core\URL::generar("usuarios/form_login_validar"); ?>'>
            
            <?php echo \core\HTML_Tag::form_registrar("form_login", "post"); ?>
            
            <div class="form-group form_login">
              <input name='login' maxsize='50' type="text" value='<?php echo \core\Datos::values('login', $datos) ?>'placeholder="Login" class="form_login"/>
            </div>
            
            <div class="form-group form_login">
              <input type="password" name='password' maxsize='50' value='<?php echo \core\Datos::values('password', $datos) ?>' placeholder="Password" class="form_login" />
            </div>
            
            <button type="submit" class="btn btn-success form_login">Log in</button>
            <br/><?php echo \core\HTML_Tag::span_error('validacion', $datos);?>
        </form>
    <?php
    }else{
        echo "<div class='navbar-form navbar-right'> Usuario: ";
        echo "<b>".\core\Usuario::$login."</b>";
        echo " <a class='btn btn-success' href='".\core\URL::generar("usuarios/desconectar")."'>Log out</a></div>";
    }
    ?>
</div>
