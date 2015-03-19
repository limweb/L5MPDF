<?php 
namespace Servit\Mpdf;

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

		$this->app->bind('mpdf.wrapper', function($app,$cfg)  {
			if($cfg) {
				$app['mpdf.pdf'] = $app->share(function($app) use($cfg){
					$mpdf = new \mPDF( $cfg[0],$cfg[1],$cfg[2],$cfg[3],$cfg[4],$cfg[5],$cfg[6],$cfg[7],$cfg[8],$cfg[9],$cfg[10] );
					$mpdf->SetProtection(array('print'));
					$mpdf->SetTitle("TOMATO POS - Invoice");
					$mpdf->SetAuthor("Thongchai Lim");
					$mpdf->SetWatermarkText("Paid");
					$mpdf->showWatermarkText = true;
					$mpdf->watermark_font = 'DejaVuSansCondensed';
					$mpdf->watermarkTextAlpha = 0.1;
					$mpdf->SetDisplayMode('fullpage');
					return $mpdf;
				});
			} else {
		    			$mpdf = new \mPDF('th','A4','','',10,10,10,10,10,5);
					$mpdf->SetProtection(array('print'));
					$mpdf->SetTitle("TOMATO POS - Invoice");
					$mpdf->SetAuthor("Thongchai Lim");
					$mpdf->SetWatermarkText("Paid");
					$mpdf->showWatermarkText = true;
					$mpdf->watermark_font = 'DejaVuSansCondensed';
					$mpdf->watermarkTextAlpha = 0.1;
					$mpdf->SetDisplayMode('fullpage');
			    		$app['mpdf.pdf'] = $mpdf;
			}
		     return new PdfWrapper($app['mpdf.pdf']);
		});

		// // work --------------------------------------------------------------------------start ----------
		// 	$this->app['mpdf.pdf'] = $this->app->share(function($app)
		// 	{
		// 		// $cfg =['th','A0','','',10,10,10,10,10,5,'L'];
		// 		$cfg = $app['config']['mpdfconfig.pdf.options'];
		// 		consolelog('cfg',$cfg);
		// 		if($cfg) {
		// 			$mpdf = new \mPDF( $cfg[0],$cfg[1],$cfg[2],$cfg[3],$cfg[4],$cfg[5],$cfg[6],$cfg[7],$cfg[8],$cfg[9],$cfg[10] );
		// 		} else {
		// 			$mpdf=new \mPDF('th','A4','','',10,10,10,10,10,5);
		// 		}
		// 		$mpdf->SetProtection(array('print'));
		// 		$mpdf->SetTitle("TOMATO POS - Invoice");
		// 		$mpdf->SetAuthor("Thongchai Lim");
		// 		$mpdf->SetWatermarkText("Paid");
		// 		$mpdf->showWatermarkText = true;
		// 		$mpdf->watermark_font = 'DejaVuSansCondensed';
		// 		$mpdf->watermarkTextAlpha = 0.1;
		// 		$mpdf->SetDisplayMode('fullpage');
		// 		return $mpdf;
		// 	});

		// 	$this->app['mpdf.wrapper'] = $this->app->share(function($app)
		// 	{
		// 		return new PdfWrapper($app['mpdf.pdf']);
		// 	});
		// // work --------------------------------------------------------------------------end----------
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

	  /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	// $this->publishes([__DIR__ . '/../../config/mpdfconfig.php' => config_path('mpdfconfig.php'),], 'config');
	// consolelog('boot');
    }
}
