<?php

/**
 * common.inc.php
 *
 * @version $Id$
 * @copyright 2011
 */
/**
 *
 *
 */
require_once('db.class.php');
$db = new DB();

require_once('poem.class.php');
$poem = new poem($db);




?>