<?php

namespace Abstractory\Forms;

require_once "Abstractory/Forms/Components/Component.php";
require_once "Abstractory/Forms/Form.php";
require_once "Abstractory/Forms/Components/ContentBlock.php";
require_once "Abstractory/Forms/Components/Input.php";
require_once "Abstractory/Forms/Components/Label.php";
require_once "Abstractory/Forms/Components/Inputs/InputElement.php";

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
$form->add("subscribButton", $submit);

//Add a custom content block
$privacyPolicy = new Components\ContentBlock("<p>Your email address will be shared with everybody!</p>");

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

