<?php
use Core\Session;
use App\Models\Users;
?>
<?= Session::displayMsg() ?>
<?= $this->content('body'); ?>