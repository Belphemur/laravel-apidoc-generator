<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 29/07/16
 * Time: 11:48 AM
 */

namespace Mpociot\ApiDoc\Tests\Fixtures;


use Mpociot\ApiDoc\Validators\IValidator;

class BasicValidator implements IValidator
{

    /**
     * Keyword used for the validator
     *
     * @return string
     */
    public static function keyword()
    {
        return 'TestValidator';
    }

    /**
     * The description of the validator with the given parameters
     *
     * @param array $parameters
     *
     * @return string
     */
    public function description(array $parameters)
    {
        return 'Must be a test of value: ' . implode(',', $parameters);
    }

    /**
     * Possibles values that are valid
     *
     * @return string[]
     */
    public function possibleValidValues()
    {
        return ['test'];
    }
}