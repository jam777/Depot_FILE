<?php

unlink($_POST['delete']);
echo '<pre>$_POST<br />'; var_dump($_POST); echo '</pre>';
header('Location: http://localhost:8000/index.php');

?>