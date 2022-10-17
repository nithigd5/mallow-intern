<?php

/**
 * Data Class for Validation Rules
 *
 */
class ValidationRule
{
    public string $name;
    public string $type;
    public ?int $min = null;
    public ?int $max = null;
    public ?string $pattern = null;
    public ?array $inList = null;
    public ?bool $isRequired = true;

    public function __construct(string $name , string $type , ?int $min = null , ?int $max = null ,
                                string $pattern = null , array $inList = null , bool $isRequired = true)
    {
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
        $this->type = $type;
        $this->pattern = $pattern;
        $this->inList = $inList;
        $this->isRequired = $isRequired;
    }

}