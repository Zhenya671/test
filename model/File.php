<?php

class File
{

    private array $file = [];
    private string $name = '';
    private string $directory = 'upload';
    private int $maxSize = 5;
    private string $error = '';
    private array $type = ['png', 'jpeg', 'txt'];


    public function set(array $file): File
    {

        $this->file = $file;

        return $this;

    }

    public function diskFreeCheck(array $file): File
    {

        if (disk_free_space('/') < $file['size']) {

            $this->error = 'low memory to upload file';

        }

        return $this;

    }

    public function showInfo()
    {


//        $array = [
//            'imageSize' => $_FILES['upload']['size'],
//            'fileName' => $this->name,
//            'imageMetaInformation' =>
//        ];


        echo $_FILES['upload']['size'] . '<br>';
        echo $this->name . '<br>';

        $typeImage = explode('.', $this->name);
        foreach ($typeImage as $value) {
            if (in_array($value, ['png', 'jpeg', 'jpg'])) {
                echo $value;
//                exif_read_data($)
            }
        }

    }

    public function executableType(): File
    {
        echo $this->name;
//            if (!is_executable($this->name)) {
//
//                return $this;
//
//            }
//            echo 'hui';
//        $this->error = 'error: executable file';
        return $this;


    }

    public function type(): File
    {
        $typeCheck = explode('.', $this->file['name']);
//        print_r($typeCheck);
        print_r($this->type);

        foreach ($this->type as $value) {

            if (in_array($value, $typeCheck)) {
                $this->error = 'invalid type';
            }
        }

        return $this;

    }

    public function name(string $name): File
    {

        $this->name = $name;

        return $this;

    }

    public function maxSize(int $size): File
    {
        if ($size > 0) {

            $this->maxSize = $size * 1024 * 1024;

        } else {
            $this->error = "maximum upload file must be integer and greater than zero";
        }

        return $this;
    }

    public function directory(string $directory): File
    {
        $this->directory = $directory;
        return $this;
    }

    public function getExtension()
    {

        $fileName = explode('.', $this->file['name']);
        return end($fileName);

    }

    public function getSize()
    {

        return $this->file['size'];

    }

    public function getDirectory(): string
    {
        if (!is_dir($this->directory)) {

            @mkdir($this->directory);

        }

        return $this->directory;
    }

    public function getName()
    {
        if (empty($this->name)) {
            $this->name = date("YmdHis");
        }

        $fileC = $this->getDirectory() . DIRECTORY_SEPARATOR . $this->name
            . "." . $this->getExtension();

        if (file_exists($fileC)) {

            $i = 0;

            do {
                $this->name .= $i;
                $fileC = $this->getDirectory() . DIRECTORY_SEPARATOR . $this->name
                    . "." . $this->getExtension();
                $i++;
            } while (file_exists($fileC));

        }

        return $this->name;
    }

    public function destination(): string
    {

        $directoryD = $this->getDirectory() . DIRECTORY_SEPARATOR;
        $directoryD .= $this->getName();
        $directoryD .= '.' . $this->getExtension();

        return $directoryD;

    }

    public function upload(): bool
    {
        if ($this->maxSize < $this->getSize()) {
            $this->error = 'File size is ' . round($this->getSize(), 2) . "<br> maximum to upload is "
                . round($this->maxSize, 2);
        }
        if (empty($this->error)) {
            return move_uploaded_file($this->file['tmp_name'], $this->destination());
        } else {
            return false;
        }
    }

    public function report(): string
    {
        return $this->error;
    }

}