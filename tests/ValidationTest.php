<?php

use \PHPWay\Validation;

class ValidationTest extends PHPUnit_Framework_TestCase
{
    public function test_should_validate_required_field()
    {
        $validation = new Validation(array(
            'the_field' => ''
        ), array(
            'the_field' => 'required'
        )); 

        $this->assertFalse($validation->validate());
        $errors = $validation->errors();
        $this->assertEquals('the_field is required', $errors['the_field']);
    }

    public function test_should_validate_required_missing_field()
    {
        $validation = new Validation(array(
        ), array(
            'the_field' => 'required'
        )); 

        $this->assertFalse($validation->validate());
        $errors = $validation->errors();
        $this->assertEquals('the_field is required', $errors['the_field']);   
    }
}