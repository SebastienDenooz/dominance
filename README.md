## Dominance

A php library to get the dominant color from an image

### Installation

__With composer__ 


__Manualy__

### Documentation


__Initialize object__

```php
$image = "/path/to/image";
$dominance = new Dominance($imgae);
echo $domiance->getDominance();
```

__Function__

* $dominance->getHEXDominantColor();
* $dominance->getRGBDominantColor();
* $dominance->getDominanceFromImageData();