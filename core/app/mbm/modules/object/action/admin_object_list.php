<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 SARUULBAT Amarsaikhan <a.saruulbat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
css_set_loadfile('/assets/flatlab/admin/assets/advanced-datatable/media/css/demo_table.css', 9);

/*
 * Notification-d ashiglagdana
 */
css_set_loadfile('/assets/flatlab/admin/assets/gritter/css/jquery.gritter.css', 91);


js_set_loadfile('/assets/flatlab/admin/assets/advanced-datatable/media/js/jquery.dataTables.js', 9);
js_set_loadfile('/assets/flatlab/admin/assets/gritter/js/jquery.gritter.js', 91);

$template->set('objects', \Object::fetchByModule('object'));
$template->set('current_module', 'object');
