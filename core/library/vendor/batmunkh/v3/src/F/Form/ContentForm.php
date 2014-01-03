<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace F\Form;

/**
 * Description here
 *
 * @package    F
 * @subpackage Form
 * @author     BATMUNKH Moltov <contact@batmunkh.com>
 * @version    SVN: $Id
 */
class ContentForm extends \F\PFBC\Form {

    public $form;

    public function __construct($form_name = 'content') {
        $form = new F\PFBC\Form($form_name);

        $form->configure(
                array(
                    'action' => get_url('admin_category_save')
                )
        );
        $form->addElement(new \F\PFBC\Element\HTML('<legend>' . __('Add new content') . '</legend>'));
        $form->addElement(new \F\PFBC\Element\Hidden('form_name', $form_name));
        $form->addElement(new \F\PFBC\Element\Textbox(__('Name') . ":", "name", array(
            "required" => 1,
            "longDesc" => __('Name field is required')
        )));
        $form->addElement(new \F\PFBC\Element\Select(__('Parent content') . ":", "content_id", array(
            1 => ''
        )));

        js_set_loadfile('/assets/ckeditor/ckeditor.js', 8);
        $form->addElement(new \F\PFBC\Element\CKEditor(__('Brief info') . ":", "content_brief"));
        $form->addElement(new \F\PFBC\Element\CKEditor(__('Content body') . ":", "content_body"));
//        $form->addElement(new \F\PFBC\Element\Captcha("Captcha:"));
        $form->addElement(new \F\PFBC\Element\Button(__("Save content")));
        $form->addElement(new \F\PFBC\Element\Button(__('Reset'), "reset", array(
            'class' => 'btn btn-danger'
        )));

        $this->form = $form;

        return $form;
    }

}
