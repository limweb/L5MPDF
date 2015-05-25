## mPDF Wrapper for Laravel 5
In development.
### License
[![Build Status](https://api.travis-ci.org/vsmoraes/pdf-laravel5.svg)](https://github.com/limweb/L5MPDF)
[![License](https://poser.pugx.org/vsmoraes/laravel-pdf/license.svg)](https://packagist.org/packages/servit/l5mpdf)

## Instalation
Add:
```
"servit/l5mpdf": "dev-master", 
```
To your `composer.json`

or Run:
```
composer require servit/l5mpdf
```

Then add:
```php
'Servit\Mpdf\ServiceProvider', 
```
To the `providers` array on your `config/app.php`

And

```php
'PDF'     => 'Servit\Mpdf\Facades\Pdf', 
```
To the `aliases` array on yout `config/app.php` in order to enable the PDF facade

## Usage

```php
$router->get('/pdf/view', function() {
       // Config::set('mpdfconfig.pdf.options',['th','A5','','',10,10,10,10,10,5,'L'] );
       // Config::set('mpdfconfig.pdf.options','"th","A0","","",10,10,10,10,6,3');
       // $mpdfcfg = Config::get('mpdfconfig');    
       // dump($mpdfcfg);
       // consolelog('mpdfcfg1',$mpdfcfg);
       $pdf = \App::make('mpdf.wrapper',['th','A0','','',10,10,10,10,10,5,'L']);
       // $pdf = \App::make('mpdf.wrapper');
       $pdf->WriteHTML('<h1>test</h1>');
       $pdf->AddPage('P'); 
       $pdf->WriteHTML('<h1>test2</h1>');
       $pdf->stream();
});
```

### Force download
```php
$router->get('/pdf/download', function() {
    $html = view('pdfs.example')->render();

    return PDF::load($html)->download();
});
```

### Output to a file
```php
$router->get('/pdf/output', function() {
    $html = view('pdfs.example')->render();

    PDF::load($html)
        ->filename('/tmp/example1.pdf')
        ->output();

    return 'PDF saved';
});
```
This mPDF Wrapper for Laravel5 is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
1


.............
/****************************/
