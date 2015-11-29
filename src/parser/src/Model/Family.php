<?php

namespace WhichBrowser\Model;

use WhichBrowser\Model\Primitive\NameVersion;

class Family extends NameVersion
{
    /**
     * Get an array of all defined properties
     *
     * @return array
     */

    public function toArray()
    {
        $result = [];

        if (!empty($this->name) && empty($this->version)) {
            return $this->name;
        }

        if (!empty($this->name)) {
            $result['name'] = $this->name;
        }

        if (!empty($this->version)) {
            $result['version'] = $this->version->toArray();
        }

        return $result;
    }
}
