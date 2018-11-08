<?php

require("model/Manager.php");

$db->exec("DELETE FROM comments WHERE id = {$_POST['id']}");