<?php

namespace Abstractory\Forms;

use Widgets\Booleans\Checkbox;
use Forms\Widgets\Booleans\RadioButtonsBoolean;

require_once "Abstractory/Forms/Component.php";
require_once "Abstractory/Forms/ComponentCollection.php";
require_once "Abstractory/Forms/Form.php";
require_once "Abstractory/Forms/Components/ContentBlock.php";
require_once "Abstractory/Forms/Components/Input.php";
require_once "Abstractory/Forms/Components/Label.php";
require_once "Abstractory/Forms/Components/Inputs/InputElement.php";

require_once 'Abstractory/Forms/Widgets/Booleans/Checkbox.php';
require_once 'Abstractory/Forms/Widgets/Booleans/RadioButtonsBoolean.php';

$inputTypes = array(
    'Button',
    'Checkbox',
    'FileInput',
    'HiddenInput',
    'PasswordInput',
    'RadioButton',
    'SelectList',
    'SubmitButton',
    'TextArea',
    'TextInput',
);

foreach ($inputTypes as $inputType) {
    require_once "Abstractory/Forms/Components/Inputs/$inputType.php";
}

//Create a new form and set properties
$form = new Form();
$form->setMethod(Form::METHOD_POST);
$form->setAction("http://www.aboynamedsu.net");

//Create an input label
$emailLabel = new Components\Label("Email Address", "emailAddress");
$form->add('emailLabel', $emailLabel);

$emailAddress = new Components\Inputs\TextInput("emailAddress", array('id' => "emailAddress"));
$form->add("emailAddress", $emailAddress);

$submit = new Components\Inputs\SubmitButton("subscribe", array('value' => 'Subscribe'));
$form->add("subscribeButton", $submit);

//Add a custom content block
$privacyPolicy = new Components\ContentBlock("<p>Your email address will be shared with everybody!</p>");

//Create a widget
$optIn = new Checkbox("optIn");
$optIn->checkbox->setId("somethingElse");
$optIn->label->setValue("I agree to give you rights to my privacy.");
$form->insertBefore("subscribeButton", "optIn", $optIn);

$rBtn = new RadioButtonsBoolean("test");
$form->insertAfter("optIn", "really", $rBtn);

//Insert at a particular point in the form. Useful for adding error messages to an existing form
$form->insertAfter("emailAddress", "privacyPolicy", $privacyPolicy);

echo $form->render();

/**
 * Output:
 *
 * <form method='POST' action='http://www.aboynamedsu.net'>
 *     <label for='emailAddress' >Email Address</label>
 *     <input type='text' name='emailAddress' id='emailAddress' />
 *     <p>Your email address will be shared with everybody!</p>
 *     <input type='submit' name='subscribe' value='Subscribe' />
 * </form>
 *
 */

