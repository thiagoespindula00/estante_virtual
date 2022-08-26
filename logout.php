<?php
    session_start();
    session_destroy();
    header("Location: /estante_virtual");
?>