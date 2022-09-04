<?php
    echo symlink($_SERVER['DOCUMENT_ROOT'] . '/public/images/', $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public/images/') ? 'Symlinked successfully' : 'There was an error while symlinking';