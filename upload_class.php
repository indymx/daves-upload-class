<?php

  class upload_class
  {

    private $path;
    private $file;
    private $dir;
    private $max;
    public $image_names = [];
    private static $types = ['image/jpeg', 'image/png', 'image/gif'];

    public function check_type($type)
    {
      if (in_array($type, $this->types, true)) {
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
      if (file_exists($dir) && is_writable($dir) === true) {
        $this->dir = $dir;
        return true;
      } else {
        $this->dir = false;
        return false;
      }
    }

    private function rearrange($arr)
    {
      foreach ($arr as $key => $items) {
        foreach ($items as $i => $val) {
          $array[$i][$key] = $val;
        }
      }
      return $array;
    }

    public function get_size($files)
    {
      $sum = array_sum($files['size']);
      if ($sum === 0) {
        return false;
      } else {
        return true;
      }
    }

    public function process_file($file)
    {
      if ($this->dir === false) {
        echo 'Invalid directory or doesnt exist!<br/>';
      } else if ($this->get_size($file) === false) {
        echo 'No file selected!<br/>';
      } else {

        $file = $this->rearrange($file);
        $x = 0;
        foreach ($file as $f) {
          if (!empty($f['name']) && $this->check_type($f['type']) === true && $f['size'] < $this->max) {

            $this->image_name = mt_rand(15, '1234567890') . $f['name'];
            $this->image_names[$x++] = $this->url . '/' . $this->image_name;
            move_uploaded_file($i['tmp_name'], $this->path . '/' . $this->image_name);
          }
        }

      } // end else
    } // end function

  }
