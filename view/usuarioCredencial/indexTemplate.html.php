<pre><center>
<?php //print_r($objUsu) ?>
<div id="titulo">
<?php echo mvc\i18n\i18nClass::__('tableusuCred', $culture = NULL, $dictionary = 'usuarioCredencial') ?>
</div>
<table border="4" width="50%">
    <button type="submit">nuevo</button>
    
    <tr>
    <th >ACTIVADO</th>     
    <th >FECHA</th>    
    <th>USUARIO</th>
    <th>CREDENCIAL</th>
    <th>ACCIONES</th> 
    
    </tr>
    
    <?php foreach ($objUsu as $key): ?>
    <tr> 
      <th><input type="checkbox"> </th>     
     <th><?php echo $key->updated_at?> </th>
     <th><?php echo $key->usuario_id?> </th> 
     <th><?php echo $key->credencial_id?> </th> 
    </tr>
    <?php endforeach; ?>
</table>
</center>
</pre>
