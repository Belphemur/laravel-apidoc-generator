<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 29/07/16
 * Time: 11:34 AM
 */

namespace Mpociot\ApiDoc\Validators;


interface IValidator
{

    /**
     * Keyword used for the validator
     *
     * @return string
     */
    public static function keyword();


    /**
     * The description of the validator with the given parameters
     *
     * @param array $parameters
     *
     * @return string
     */
    public function description(array $parameters);

    /**
     * Possibles values that are valid
     *
     * @return string[]
     */
    public function possibleValidValues();
}