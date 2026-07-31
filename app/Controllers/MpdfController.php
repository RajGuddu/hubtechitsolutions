<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Mpdf\Mpdf;

class MpdfController extends BaseController
{
    private $service_model;
    private $common_model;
    public function __construct()
    {
        $this->service_model = model('App\Models\Service_model', false);
        $this->common_model = model('App\Models\Common_model', false);
    }

    public function get_offer_letter_pdf($ia_id){ // for mail attach in home controller 
        // $student = $this->service_model->get_one_internship_student_detail($ie_id);
        $student = $this->service_model->get_one_internship_course_detail($ia_id);
        $html = view('pdfhtml/intern_offer_letter', ['student'=>$student]);
        $result = $this->generate_pdf($html);
        return $result;
    }
    public function get_offer_letter_pdf_for_modal($ia_id){ //admin panel
        $student = $this->service_model->get_one_internship_course_detail($ia_id);
        $html = view('pdfhtml/intern_offer_letter', ['student'=>$student]);
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML($html);

        // return $mpdf->Output('', 'S'); // PDF string return
        // return $mpdf->Output('Offer_letter.pdf', 'I');
        $fileName = 'Offer_Letter_' . $student->enroll_id . '.pdf';
        $pdf = $mpdf->Output($fileName, \Mpdf\Output\Destination::STRING_RETURN);
        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="'.$fileName.'"')
            ->setBody($pdf);
    }

    /****************Creating PDF************** */
    public function generate_pdf($html){
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('', 'S'); // PDF string return
        // $mpdf->Output('Offer_letter.pdf', 'I'); exit;
    }
    /**********************For modal******************* */
    public function view_pdf($file){
        // echo 'Hi'. $file; exit;
        $path = './' . PDF_PATH . $file;

        if ($file == NULL || !file_exists($path)) {
            return '
            <div style="padding:50px;text-align:center;font-family:Arial;">
                <h3>📄 File not uploaded yet.</h3>
                <p>Please contact the administrator.</p>
            </div>';
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($path) . '"')
            ->setBody(file_get_contents($path));
    }

    /***********Testing*********** */
    public function _get_offer_letter_pdf($ie_id){
        $student = $this->service_model->get_one_internship_student_detail($ie_id);
        $html = view('pdfhtml/intern_offer_letter', ['student'=>$student]);
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML($html);

        // return $mpdf->Output('', 'S'); // PDF string return
        $mpdf->Output('Offer_letter.pdf', 'I'); exit;
    }
}