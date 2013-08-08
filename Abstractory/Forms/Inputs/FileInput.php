<?php

/**
 * FileInput
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
class FileInput extends InputElement {
    
    protected $maxFileSize;

    protected function getType() {
        return "file";
    }
    
    public function setMaxFileSize($bytes) {
        $this->maxFileSize = $bytes;
    }

}

