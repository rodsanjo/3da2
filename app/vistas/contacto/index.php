<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/validaciones/val_contacto.js"></script>
<style>
    input, textarea{
        background: khaki;
    }
</style>
    
<h1 class="titulo_seccion"><?php echo ucfirst(iText('contacto', 'dicc')); ?></h1>
<p>
    Si quiere ponerse en contacto con nostros para cualquier consulta, puede hacerlo a través de 
    nuestro correo electrónico: <a href="mailto:jergo23@gmail.com">jergo23@gmail.com</a> 
    o bien mediante el siguiente formulario y le contestaremos lo antes posible.
</p>
<form onsubmit="return validarForm();" name="formulario" action="<?php echo \core\URL::generar("contacto/enviar_mail"); ?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <legend>Formulario de contacto</legend>
        <label for="nombre">Nombre:</label>
        <input id="nombre" onblur="validarNombre();" type="text" name= "nombre" value="<?php echo \core\Array_Datos::values('nombre', $datos); ?>" size="20" maxlength="30"/>
        <?php echo \core\HTML_Tag::span_error('nombre', $datos); ?>
        <br/>
        
        <label for="email">Dirección de correo electrónico:</label>
        <input id="email" type="text" name="email" value="<?php echo \core\Array_Datos::values('email', $datos); ?>"/><br/>
        <?php echo \core\HTML_Tag::span_error('email', $datos); ?>
        <br/>
        
        <label for="asunto">Asunto:</label>
        <input id="asunto" type="text" name="asunto" value="<?php echo \core\Array_Datos::values('asunto', $datos); ?>"/><br/>
        <?php echo \core\HTML_Tag::span_error('asunto', $datos); ?>
        <br/>
        
        <label for="mensaje">Mensaje:</label><br/>
        <textarea id="mensaje" name="mensaje" cols="100" rows="5"><?php echo \core\Array_Datos::values('mensaje', $datos); ?></textarea><br/>
        <?php echo \core\HTML_Tag::span_error('mensaje', $datos); ?>
        <br/>
        
        <small><p>*Atención: Todos los campos son obligatorios.</p></small>

        <input type="submit" name="enviar" value="Enviar" />
    </fieldset>
</form>

<script type="text/javascript">
    
</script>
