<?php

if (false) {
    require_once ROOT_PATH . '/config/dev.php';
}

/*
 * Path to data.
 */
$config['data_location'] = ROOT_PATH.'/data';

/*
 * \DateTime format for date output.
 */
//$config['date_format'] = 'Y-m-d h:i:s';
$config['date_format'] = 'c';

/*
 * Hint on how to use this API.
 */
$config['usage'] = 'Usage: Try calling host/survey/list or host/survey/XX2. See host/usage';
