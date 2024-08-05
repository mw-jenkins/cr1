<?php

namespace genTree;

use Exception;

class CsvReaderClass
{
    public $fileHandle;
    public string $delimiter;
    public array $header;

    public function __construct(string $filename, string $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception("File $filename does not exist or is not readable.");
        }
        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'csv') {
            throw new Exception("$filename File must have .csv extension");
        }

        $this->fileHandle = fopen($filename, "r");
        $this->delimiter = $delimiter;
        $this->setHeader();
    }

    public function setHeader()
    {
        if ($this->fileHandle !== false) {
            $this->header = fgetcsv($this->fileHandle, 0, $this->delimiter);
        }
    }

    public function read(): array
    {
        $data = [];
        if ($this->fileHandle !== false) {
            while (($row = fgetcsv($this->fileHandle, 0, $this->delimiter)) !== false) {
                if ($this->header !== $row) {
                    $data[] = array_combine($this->header, $row);
                }
            }
            fclose($this->fileHandle);
        }
        return $data;
    }
}
