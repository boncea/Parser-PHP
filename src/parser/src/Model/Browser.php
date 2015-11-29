<?php

namespace WhichBrowser\Model;

use WhichBrowser\Model\Primitive\NameVersion;

class Browser extends NameVersion
{
    /** @var string */
    public $channel;

    /** @var \WhichBrowser\Model\Using */
    public $using;

    /** @var \WhichBrowser\Model\Family */
    public $family;

    /** @var boolean */
    public $stock = true;

    /** @var boolean */
    public $hidden = false;

    /** @var string */
    public $mode = '';


    /**
     * Set the properties to the default values
     */

    public function reset()
    {
        parent::reset();

        unset($this->channel);
        unset($this->useing);
        unset($this->family);

        $this->stock = true;
        $this->hidden = false;
        $this->mode = '';
    }


    /**
     * Get the name in a human readable format
     *
     * @return string
     */

    public function getName()
    {
        $name = !empty($this->alias) ? $this->alias : (!empty($this->name) ? $this->name : '');
        return $name ? $name . (!empty($this->channel) ? ' ' . $this->channel : '') : '';
    }


    /**
     * Is the browser using the specified webview
     *
     * @param  string   $s      The name of the webview
     *
     * @return boolean
     */

    public function isUsing($s)
    {
        if (isset($this->using)) {
            if ($this->using->getName() == $s) {
                return true;
            }
        }

        return false;
    }


    /**
     * Get a combined name and version number in a human readable format
     *
     * @return string
     */

    public function toString()
    {
        $result = trim(($this->hidden == false ? $this->getName() . ' ' : '') . $this->getVersion());

        if (empty($result) && isset($this->using)) {
            return $this->using->toString();
        }

        return $result;
    }


    /**
     * Get an array of all defined properties
     *
     * @return array
     */

    public function toArray()
    {
        $result = [];

        if (!empty($this->name)) {
            $result['name'] = $this->name;
        }
        
        if (!empty($this->alias)) {
            $result['alias'] = $this->alias;
        }
        
        if (!empty($this->using)) {
            $result['using'] = $this->using->toArray();
        }
        
        if (!empty($this->family)) {
            $result['family'] = $this->family->toArray();
        }
        
        if (!empty($this->version)) {
            $result['version'] = $this->version->toArray();
        }

        if (isset($result['name']) && empty($result['name'])) {
            unset($result['name']);
        }
        
        if (isset($result['version']) && !count($result['version'])) {
            unset($result['version']);
        }

        return $result;
    }
}
