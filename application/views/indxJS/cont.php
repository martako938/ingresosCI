<script>    <?php  $base = base_url(); echo "const base = '$base'"; ?>     </script>


<?php //defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $v = rand(1, 100); ?>

<script src="<?= base_url( 'js/appContacto.js?v=0.'.$v ) ?>"></script>

