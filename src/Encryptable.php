<?php

namespace BenInada\Eloquent;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Get model attribute.
     *
     * @param  $key
     * @return $value
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable) && $value !== '') {
            $value = Crypt::decrypt($value);
        }

        return $value;
    }
    /**
     * Set model attribute.
     *
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            if (is_null($value)) {
                $value = null;
            } else {
                $value = Crypt::encrypt($value);
            }
        }

        return parent::setAttribute($key, $value);
    }
    /**
     * Get an array of the model attributes.
     *
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = Crypt::decrypt($attributes[$key]);
            }
        }

        return $attributes;
    }
}
