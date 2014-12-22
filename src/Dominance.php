<?php

class Dominance {

    protected $SUPPORTED_TYPES = [1, 2, 3];

    private $_image_file;
    private $_image_type;
    private $_dominant_red;
    private $_dominant_green;
    private $_dominant_blue;


    function __construct($image)
    {
        if (is_file($image)){

            $this->_image_type = exif_imagetype($image);

            if ( ! in_array( $this->_image_type, $this->SUPPORTED_TYPES) ){

                throw new ErrorException("Not a supported image file");

            } else {

                $this->_image_file = $image;
                $this->_getImageDominance();

            }

        } else {

            throw new ErrorException("Not a valid file");

        }
    }

    public function getHEXDominantColor() {
        $hex = "#";
        $hex .= str_pad(dechex($this->_dominant_red), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($this->_dominant_green), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($this->_dominant_blue), 2, "0", STR_PAD_LEFT);
        return $hex;
    }

    public function getRGBDominantColor(){
        return $this->_dominant_red.",".$this->_dominant_green.",".$this->_dominant_blue;
    }



    private function _getImageDominance(){

        $rTotal = "";
        $gTotal = "";
        $bTotal = "";
        $total = "";

        $_image = null;

        switch(exif_imagetype ( $this->_image_file ))
        {

            case 1:
                $_image = imagecreatefromgif($this->_image_file);
                break;
            case 2:
                $_image = imagecreatefromjpeg($this->_image_file);
                break;
            case 3:
                $_image = imagecreatefrompng($this->_image_file);
                break;
            default:
                throw new ErrorException("Impossible to extract image");
        }

        for ( $x = 0; $x < imagesx($_image); $x++) {

            for ( $y = 0; $y < imagesy($_image); $y++) {

                $rgb = imagecolorat($_image,$x,$y);
                $red = ($rgb >> 16) & 0xFF;
                $green = ($rgb >> 0) & 0xFF;
                $blue = $rgb & 0xFF;

                $rTotal += $red;
                $gTotal += $green;
                $bTotal += $blue;
                $total++;

            }

        }

        $rAverage = round($rTotal/$total);
        $gAverage = round($gTotal/$total);
        $bAverage = round($bTotal/$total);

        $this->_dominant_red = $rAverage;
        $this->_dominant_green = $gAverage;
        $this->_dominant_blue = $bAverage;

    }

    function __toString()
    {

        return $this->_dominant_red.",".$this->_dominant_green.",".$this->_dominant_blue;

    }


}