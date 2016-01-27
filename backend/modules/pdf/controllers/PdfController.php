<?php
namespace backend\modules\pdf\controllers;

use backend\components\utilities;
use common\widgets\Pdfbill;
use Yii;
use yii\base\Controller;

class PdfController
{
    /**
	 *
	 * @param type $info_warranty
	 * @param type $info_car
	 * @param type $info_bill
	 * @param type $info_ss
	 * @param type $denpyoNo
	 * @param type $savetype
	 * @param type $watermark 1 has lock
	 * @return boolean|string
	 */
	public function exportBill($info_warranty = array(), $info_car = array(), $info_bill = array(), $info_ss = array(),$denpyoNo, $savetype = null, $watermark = null)
    {
		$data = [
            'info_warranty' => $info_warranty,
            'info_car' => $info_car,
            'info_bill' => $info_bill,
            'info_ss' => $info_ss
        ];

        $stringTarget = Pdfbill::widget($data);

        $pdf = new \mPDF('ja', 'A4', 0, 'DejaVuSansCondensed', '4', '4', '4', '4', '4', '4');
        $pdf->WriteHTML($stringTarget);
        if ($watermark) {
            $pdf->SetWatermarkImage('../web/img/confidentiality.png', 0.6);
            $pdf->showWatermarkImage = true;
        }
        utilities::createFolder('data/pdf');//Create folder data/pdf
        if ($savetype == 'save') {

			if (file_exists('data/pdf/'.$denpyoNo.'.pdf')) {
                return false;
            }
            $pdf->Output('data/pdf/'.$denpyoNo.'.pdf', 'F');
            if (file_exists('data/pdf/'.$denpyoNo.'.pdf')) {
                return true;
            }
        } else {
            $pdf->Output('data/pdf/review.pdf', 'F');
			return 'data/pdf/review.pdf';
        }

    }
	public function checkExists($denpyoNo) {
		return file_exists('data/pdf/'.$denpyoNo.'.pdf');
	}
}
