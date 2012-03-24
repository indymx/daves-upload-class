<?php class Upload
{

    private $path;
    private $file;
    private $dir;
    private $max;
    private $types = array('application/msword', 'application/pdf', 'image/jpeg',
        'image/png', 'image/gif');

    public function check_type($type)
    {
        if (in_array($type, $this->types)) {
            return true;
        } else {
            return false;
        }
    }
    public function set_max($max)
    {
        if (is_int($max)) {
            $this->max = $max;
            return true;
        } else {
            return false;
        }
    }
    public function set_dir($dir = false)
    {
        if (file_exists($dir) && is_writable($dir) == true) {
            $this->dir = $dir;
            return true;
        } else {
            $this->dir = false;
            return false;
        }
    }
    public function if_exists($file_name)
    {
        if (file_exists($this->dir . '/' . $file_name)) {
            return true;
        } else {
            return false;
        }
    }
    public function process_file($file)
    {
        if ($file['size'] > $this->max) {
            echo 'The file is too large!';
        } elseif ($this->check_type($file['type']) == false) {
            echo 'Invalid file!';
        } elseif ($this->dir == false) {
            echo 'Invalid directory or doesnt exist!';
        } elseif ($this->if_exists($file['name']) == true) {
            echo 'File already exists!';
        } else {
            move_uploaded_file($file['tmp_name'], $this->dir . '/' . $file['name']);
            echo "Stored in: " . $this->dir . '/' . $file['name'];
        }
    }

} ?>