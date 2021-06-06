<?php if(isset($categoria->id)):?>
    <input type="hidden" name="idfacultad" value="<?php echo $categoria->id;?>">
<?php endif;?>
<div class="form-group <?php echo form_error('nombre') == true ? 'has-error' : '' ?>">
	<div class="col-md-12">
		<label for="nombre">Nombre:</label>
	    <?php if(isset($categoria->nombre)):?>
	      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $categoria->nombre;?>" required>
	      <?php echo form_error('nombre'); ?>
	    <?php else:?>
	      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"required>
	      <?php echo form_error('nombre'); ?>
	    <?php endif;?>
	</div>
</div>