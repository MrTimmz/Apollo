<?php

session_start();
session_unset();
session_destroy();

//going back
header("location: ../index.php?error=none");