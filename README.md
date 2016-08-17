# o2pdf
API to convert office files to PDF directly

## How to

```` php
    use O2Pdf\OfficeToPdf;
    
    $office = new OfficeToPdf('absolute/url/to/office/file/online');
    $pdfUrl = $office->getPdfUrl();
    var_dump($pdfUrl);
````

