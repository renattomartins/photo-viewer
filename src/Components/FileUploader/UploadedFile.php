<?php

namespace Components\FileUploader;

interface UploadedFile
{
    public function setTargetDir($targetDir);
    public function setMaxAllowedSize($maxAllowedSize);
    public function isValid();
    public function save();
}
