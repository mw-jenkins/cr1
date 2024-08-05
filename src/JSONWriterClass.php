<?php

namespace genTree;

use Exception;

class JSONWriterClass
{
    public string $filename;

    public function __construct($filename)
    {
        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'json') {
            throw new Exception("$filename Invalid file extension, expected .json");
        }

        if (!is_writable(dirname($filename))) {
            throw new Exception(sprintf('Directory "%s" is not writable', dirname($filename)));
        }

        $this->filename = $filename;
    }

    public function write($data): bool
    {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new Exception('Error encoding data to JSON');
        }

        $result = file_put_contents($this->filename, $json);
        if ($result === false) {
            throw new Exception('Error writing data to file');
        }

        return true;
    }
}