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
    private function rearrange( $arr ){
        foreach($arr as $key => $items){
            foreach($items as $i => $val){
                $array[$i][$key] = $val;
            }
        }
        return $array;
    }
    public function process_file($file)
    {
        if ($this->dir == false) {
            echo 'Invalid directory or doesnt exist!<br/>';
        } else {
               
            $file = $this->rearrange($file);
            foreach($file as $f){
                if ($f['size'] > $this->max) {
                    echo 'The file is too large!'.'<br/>';
                } elseif ($this->check_type($f['type']) == false) {
                    echo 'Invalid file!'.'<br/>';
                } elseif ($this->if_exists($f['name']) == true) {
                    echo 'File already exists!'.'<br/>';
                } else {
                    move_uploaded_file($f['tmp_name'], $this->dir . '/' . $f['name']);
                    echo "Stored in: " . $this->dir . '/' . $f['name'].'<br/>';
                }
                
            } 

        } // end else
    } // end function

} ?>