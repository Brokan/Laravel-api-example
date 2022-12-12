<?php

namespace App\Models\Traits;

/**
 * Models trait, to encrypt and decrypt values to and from database.
 */
trait EncryptsAttributes_v2 {

    /**
     * Attributes to array.
     * @return array
     */
    public function attributesToArray(): array {
        $attributes = parent::attributesToArray();
        foreach ($this->getEncrypts() as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = $this->decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }

    /**
     * Get attribute value.
     * @param string $key
     * @return string
     */
    public function getAttributeValue($key) {
        if (in_array($key, $this->getEncrypts())) {
            return $this->decrypt($this->attributes[$key]);
        }
        return parent::getAttributeValue($key);
    }

    /**
     * Set attribute as encrypted.
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setAttribute($key, $value) {
        if (in_array($key, $this->getEncrypts())) {
            $this->attributes[$key] = $this->encrypt($value);
        } else {
            parent::setAttribute($key, $value);
        }
        return $this;
    }

    /**
     * Get list of fields to encrypt.
     * @return type
     */
    protected function getEncrypts(): array {
        return property_exists($this, 'encrypts') ? $this->encrypts : [];
    }

    /**
     * Encrypt string.
     * @param string $raw
     * @param string $encryption_key
     * @return string
     */
    public function encrypt(string $raw) : string {
        //There was better encryption, but will not make it public.
        return base64_encode($raw);
    }

    /**
     * Decrypt string.
     * @param string $encrypted
     * @param string $encryption_key
     * @return string
     */
    public function decrypt(string $encrypted) : string {
        //There was better encryption, but will not make it public.
        return base64_decode($encrypted);
    }

}
