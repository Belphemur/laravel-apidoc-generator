<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 29/07/16
 * Time: 11:43 AM
 */

namespace Mpociot\ApiDoc\Validators;

use Illuminate\Support\Str;


/**
 * Class ValidatorRegistery
 *
 * @package Mpociot\ApiDoc\Validators
 */
class ValidatorRegistry
{

    /**
     * @var IValidator[]
     */
    private $validators = [];

    /**
     * Register a validator
     *
     * @param IValidator $validator
     */
    public function register(IValidator $validator)
    {
        $this->validators[Str::lower($validator::keyword())] = $validator;
    }

    /**
     * Unregister a validator
     *
     * @param IValidator $validator
     */
    public function unRegister(IValidator $validator)
    {
        unset($this->validators[Str::lower($validator::keyword())]);
    }

    /**
     * Get a validator
     *
     * @param string $rule
     *
     * @return IValidator
     */
    public function getValidator(string $rule)
    {
        return $this->validators[Str::lower($rule)];
    }

    /**
     * Is there a validator for the given rule
     *
     * @param string $rule
     *
     * @return bool
     */
    public function hasValidator(string $rule)
    {
        return isset($this->validators[Str::lower($rule)]);
    }
}