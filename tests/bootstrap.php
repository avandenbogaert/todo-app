<?php

passthru(sprintf(
    'APP_ENV=%s php "%s/../bin/console" doctrine:schema:update -q --force',
    'test',
    __DIR__
));

passthru(sprintf(
    'APP_ENV=%s php "%s/../bin/console" doctrine:fixtures:load -q',
    'test',
    __DIR__
));

require __DIR__.'/../config/bootstrap.php';