<?php  if (count($errors) > 0) : ?>
  <div class="errors" style="color:red;font-size:12px;">
  	<?php foreach ($errors as $error) : ?>
  	  <?php echo $error ?><br>
  	<?php endforeach ?>
  </div>
<?php  endif ?>