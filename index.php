<?php

use Utils\FlashMessageHelper;

session_start();

require_once __DIR__."/utils/FlashMessageHelper.php";
require_once "Route.php";

    FlashMessageHelper::getFlashMessage();
    Route::contentToRender();
?>