# o2pdf
API to convert office files to PDF directly

## How to

````
    composer require mrofi/o2pdf
````


```` php
    require 'vendor/autoload.php';

    $office = new O2Pdf\OfficeToPdf('absolute/url/to/office/file/online');
    $pdfUrl = $office->getPdfUrl();
    header('location: '.$pdfUrl);
    // or
    // var_dump($pdfUrl);
````
