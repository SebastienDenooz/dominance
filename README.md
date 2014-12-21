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

* $dominance->getHEXColor();
* $dominance->getRGBColor();
* $dominance->getCMJNColor();
* $dominance->writeDominanceInformationInEXIF();
* $dominance->getDominanceFromEXIF();
* $dominance->getDominanceFromImageData();