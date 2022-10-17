<?php

require_once "utilities.php";
require_once "ValidationRule.php";

/**
 * Sanitizes the form input data and Validates a Form Data by given constraints.
 * Validation Rule Type Can be -> email, int, float, string, ip, domain and ip
 * Call validate method to validate the function
 */
class FormValidator
{
    public bool $isValid = true;
    public array $errors = array();

    public string $required_error = "Input is Required.";
    public string $length_error = "Input length should be between %s to %s";
    public string $input_error = "Invalid Input";
    /**
     * @var ValidationRule[]
     */
    private array $rules;

    public function __construct(public array $formData , public array $files)
    {
    }

    public function sanitize($data): string
    {
        $data = trim($data);
        return htmlspecialchars($data);
    }

    public function getFilter($type): int
    {
        return match ($type) {
            "bool" => FILTER_VALIDATE_BOOLEAN ,
            "domain" => FILTER_VALIDATE_DOMAIN ,
            "email" => FILTER_VALIDATE_EMAIL ,
            "float" => FILTER_VALIDATE_FLOAT ,
            "int" => FILTER_VALIDATE_INT ,
            "ip" => FILTER_VALIDATE_IP ,
            default => FILTER_UNSAFE_RAW ,
        };
    }

    function validateNumberRange(ValidationRule $rule , $data): bool
    {
        return $data >= $rule->min && $data <= $rule->max;
    }

    function validateStringLength(ValidationRule $rule , $data): bool
    {
        $l = strlen($data);
        return $l >= $rule->min && $l <= $rule->max;
    }

    function validateLength(ValidationRule $rule , $data): bool
    {
        if (!$rule->min || !$rule->max)
            return true;

        if ($rule->type === "int" || $rule->type === "float") {
            return $this->validateNumberRange($rule , $data);
        }

        return $this->validateStringLength($rule , $data);
    }

    function validateDate(ValidationRule $rule , $data): DateTime|bool
    {
        if (empty($rule->pattern)) $rule->pattern = 'Y-m-d';

        $date = DateTime::createFromFormat($rule->pattern , $data);
        if (!$date) {
            return false;
        } else {
            return $date;
        }
//        if (!preg_match($rule->pattern, $data, $match)) return false;
//        return checkdate($match[2], $match[3], $match[1]);
    }

    function validatePattern(ValidationRule $rule , $data): bool
    {
        if (!$rule->pattern) return true;
        return preg_match(preg_quote($rule->pattern) , $data);
    }

    function setError(string $type , string $name , bool $clear = false , ValidationRule $rule = null): void
    {
        switch ($type) {
            case "required" :
            {
                $this->errors[$name] = $this->required_error;
                $this->setInvalid();
                break;
            }
            case "input" :
            {
                $this->errors[$name] = $this->input_error;
                $this->setInvalid();
                break;
            }
            case "length" :
            {
                $this->errors[$name] = sprintf($this->length_error , $rule->min , $rule->max);
                $this->setInvalid();
                break;
            }
        }
        if ($clear) $this->formData[$name] = null;
    }

    public function validate(ValidationRule ...$rules): bool
    {

        foreach ($rules as $rule) {

            $name = $rule->name;

            if ($rule->type == 'file') {
                $e = $this->validateFile($name , $rule);
                if ($e !== UPLOAD_ERR_OK) {
                    $this->setFileError($e , $name , $rule->max);
                }
                continue;
            }

            //Checks if data is present and required
            if (empty($this->formData[$name]) && $rule->isRequired) {
                $this->setError("required" , $name);
                continue;
            }

            //Sanitizes Data
            $this->formData[$name] = $this->sanitize($this->formData[$name]);

            //Checks DataType
            $this->formData[$name] = filter_var($this->formData[$name] ,
                $this->getFilter($rule->type));

            $data = $this->formData[$name];

            if (!$this->formData[$name] && $rule->isRequired) {
                $this->setError("input" , $name);
                continue;
            }

            //Validates if it is date
            if ($rule->type === "date") {
                $date = $this->validateDate($rule , $data);
                if (!$date) {
                    $this->setError("input" , $name);
                    continue;
                }
                $this->formData[$name] = $date;
            }

            if (!empty($rule->inList)) {
                if (!in_array($this->formData[$name] , $rule->inList)) {
                    $this->setError("input" , $name , clear: true);
                    continue;
                }
            } else {
                if (!$this->validateLength($rule , $data)) {
                    $this->setError("length" , $name , rule: $rule);
                    continue;
                }

                if ($rule->type === 'string' && !$this->validatePattern($rule , $data)) {
                    $this->setError("input" , $name);
                    continue;
                }
            }

            $this->isValid = $this->isValid & true;
            $this->errors[$name] = "";
        }
        return $this->isValid;
    }

    /** Sets Form Invalid
     * @return void
     */
    public function setInvalid(): void
    {
        $this->isValid = $this->isValid & false;
    }

    function validateFile(string $name , $rule): int
    {
        if (!isset($this->files)) return UPLOAD_ERR_NO_FILE;
        if (empty($this->files[$name]))
            return UPLOAD_ERR_NO_FILE;

        if ($this->files[$name]['error'] != UPLOAD_ERR_OK) {
            return $this->files[$name]['error'];
        }

        $check = getimagesize($this->files[$name]["tmp_name"]);

        if (!$check) return -1;

        $size = filesize($this->files[$name]["tmp_name"]);
        if (!empty($rule->max) && $size > $rule->max) return UPLOAD_ERR_INI_SIZE;

        $file = move_uploaded_image_file($this->files[$name]["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/uploads");
        if (!$file) return UPLOAD_ERR_CANT_WRITE;

        $this->formData['profile'] = $file;
        return UPLOAD_ERR_OK;
    }

    private function setFileError(int $e , string $name , $max = null): void
    {
        $this->setInvalid();
        switch ($e) {
            case UPLOAD_ERR_NO_FILE:
            {
                $this->errors[$name] = $this->required_error;
                break;
            }
            case UPLOAD_ERR_INI_SIZE :
            {
                if (empty($max)) $max = ini_get("upload_max_filesize");
                $this->errors[$name] = "Maximum file Upload Size reached ( > ${max} bytes)";
                break;
            }
            default :
            {
                $this->errors[$name] = $this->input_error;
            }
        }
    }
}