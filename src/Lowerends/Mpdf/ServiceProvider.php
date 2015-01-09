<?php namespace Servit\Mpdf;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
//use TFox\MpdfPortBundle\Service\MpdfService as mPDF;

include base_path('vendor/mpdf/mpdf/mpdf.php');


class ServiceProvider extends BaseServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('Servit/Mpdf');

		if($this->app['config']->get('Mpdf::config.pdf.enabled')){
			$this->app['mpdf.pdf'] = $this->app->share(function($app)
			{
				$base = $app['config']->get('Mpdf::config.pdf.base');
				$options = $app['config']->get('Mpdf::config.pdf.options');
				$mpdf=new \mPDF('win-1252','A4','','',10,10,40,35,10,5);
				$mpdf->SetProtection(array('print'));
				$mpdf->SetTitle("Acme Trading Co. - Invoice");
				$mpdf->SetAuthor("Acme Trading Co.");
				$mpdf->SetWatermarkText("Paid");
				$mpdf->showWatermarkText = false;
				$mpdf->watermark_font = 'DejaVuSansCondensed';
				$mpdf->watermarkTextAlpha = 0.1;
				$mpdf->SetDisplayMode('fullpage');

				return $mpdf;
			});

			$this->app['mpdf.wrapper'] = $this->app->share(function($app)
			{
				return new PdfWrapper($app['mpdf.pdf']);
			});
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mpdf.pdf', 'mpdf.wrapper');
	}

}