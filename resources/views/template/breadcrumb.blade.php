<ol class="chupy-breadcrumb breadcrumb">
<?php
  $breadcrumb_uri = explode('/', $_SERVER['REQUEST_URI']);
  $values = '';
  $keys = array_keys($breadcrumb_uri);

  $first_key = array_keys($breadcrumb_uri)[0];
  $last_key = end($keys);

  foreach ($breadcrumb_uri as $key => $value) {
      if ($key == $first_key) {
          $values = '/'
?>
    <li class="breadcrumb-item">
      <a href="<?php echo $values; ?>">
        <?php echo 'Beranda <br>'; ?>
      </a>
    </li>

<?php
      } elseif ($key != $last_key) {
        $values .= $value;
          ?>
    <li class="breadcrumb-item">
      <a href="<?php echo $values; ?>">
        <?php echo ucfirst($value.'<br>'); ?>
      </a>
    </li>
<?php
        $values .= '/'; 
      } else {
          $values .= $value; ?>
    <li class="breadcrumb-item active">
      <a href="<?php echo $values; ?>">
        <?php echo ucfirst($value.'<br>'); ?>
      </a>
    </li>
<?php
      }
  }
?>
</ol>
