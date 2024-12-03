<?php

class Validator {
    private $errors = [];

    public function getErrors() {
        return $this->errors;
    }

    public function isValid() {
        return empty($this->errors);
    }

    public function required($field, $value, $message = null) {
        if (empty(trim($value))) {
            $this->addError($field, $message ?? "$field is required.");
        }
    }


    public function minLength($field, $value, $min, $message = null) {
        if (strlen($value) < $min) {
            $this->addError($field, $message ?? "$field must be at least $min characters long.");
        }
    }

    public function maxLength($field, $value, $max, $message = null) {
        if (strlen($value) > $max) {
            $this->addError($field, $message ?? "$field must be less than $max characters long.");
        }
    }

    public function email($field, $value, $message = null) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $message ?? "$field must be a valid email address.");
        }
    }

    public function numeric($field, $value, $message = null) {
        if (!is_numeric($value)) {
            $this->addError($field, $message ?? "$field must be a number.");
        }
    }

    public function validateFile($field, $file, $allowedTypes = [], $allowedExtensions = [], $maxSize = 0, $message = null) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->addError($field, "$field upload failed.");
            return;
        }

        $fileType = mime_content_type($file['tmp_name']);
        if (!empty($allowedTypes) && !in_array($fileType, $allowedTypes)) {
            $this->addError($field, "$field must be one of the following types: " . implode(', ', $allowedTypes));
        }

        if ($maxSize > 0 && $file['size'] > $maxSize) {
            $this->addError($field, "$field must be smaller than " . ($maxSize / (1024 * 1024)) . "MB.");
        }
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $this->addError($field, "$field must be one of the following types: " . implode(', ', $allowedTypes));
        }
    }

    private function addError($field, $message) {
        $oldMessage = $this->errors[$field]??'';
        $this->errors[$field] =  $oldMessage.$message;
    }
}
