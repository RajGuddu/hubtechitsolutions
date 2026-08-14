<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Mpdf\Mpdf;
use Endroid\QrCode\Builder\Builder;

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
    public function cover_page_pdf($_ia_id){
        $ia_id = base64_decode($_ia_id);
        $record = $this->service_model->get_one_internship_course_detail($ia_id);
        $html = view('pdfhtml/cover_page', ['record'=>$record]);
        $fileName = 'Cover_Page_'.$record->cert_no;
        return $this->common_pdf_generator_for_modal($html, $fileName);
    }
    public function atten_cert_pdf($_ia_id){ //attendance
        $ia_id = base64_decode($_ia_id);
        ini_set('pcre.backtrack_limit', '5000000');
        ini_set('pcre.recursion_limit', '5000000');
        $student = $this->service_model->get_one_internship_course_detail($ia_id);
        $acimage = FCPATH.CERT_PATH.'Attendance_Certificate.png';
        $data['acimage'] = $this->createimage($acimage);
        $data['record'] = $student;
        $html = view('pdfhtml/attendance_cert', $data);
        $fileName = 'Attendance_Cert_'.$student->cert_no;
        return $this->common_pdf_generator_for_modal($html, $fileName);
    }
    public function intern_cert_pdf($_ia_id){ //certificate
        $ia_id = base64_decode($_ia_id);
        ini_set('pcre.backtrack_limit', '5000000');
        ini_set('pcre.recursion_limit', '5000000');
        $student = $this->service_model->get_one_internship_course_detail($ia_id);
        $acimage = FCPATH.CERT_PATH.'Internship_Certificate.png';
        $dpimage = FCPATH.IMAGE_PATH.$student->image;
        $data['dpimage'] = $this->createimage($dpimage);
        $data['acimage'] = $this->createimage($acimage);
        $data['record'] = $student;

        $qr = Builder::create()
            ->data(base_url('intern-certificate-verification?cert_no=' . $student->cert_no))
            ->size(150)
            ->margin(0)
            ->build();

        $data['qr_image'] = 'data:image/png;base64,' . base64_encode($qr->getString());

        $html = view('pdfhtml/intern_cert', $data);
        $fileName = 'Internship_Cert_'.$student->cert_no;
        // echo $html;exit;
        return $this->common_pdf_generator_for_modal($html, $fileName);
    }
    private function common_pdf_generator_for_modal($html, $_fileName){
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
        $fileName = $_fileName . '.pdf';
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
    private function createimage($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $image;
    }


    /***********Testing*********** */
    public function i_c_pdf(){ //certificate
        ini_set('pcre.backtrack_limit', '5000000');
        ini_set('pcre.recursion_limit', '5000000');
        $student = $this->service_model->get_one_internship_course_detail(3);
        $acimage = FCPATH.CERT_PATH.'Internship_Certificate.png';
        $dpimage = FCPATH.IMAGE_PATH.$student->image;
        $data['dpimage'] = $this->createimage($dpimage);
        $data['acimage'] = $this->createimage($acimage);
        $data['record'] = $student;

        $qr = Builder::create()
            ->data(base_url('intern-certificate-verification?cert_no=' . $student->cert_no))
            ->size(150)
            ->margin(0)
            ->build();

        $data['qr_image'] = 'data:image/png;base64,' . base64_encode($qr->getString());

        $html = view('pdfhtml/intern_cert', $data);
        // echo $html;exit;
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
        $mpdf->Output('intern_cert.pdf', 'I'); exit;
    }
    public function a_c_pdf(){ //attendance
        $student = $this->service_model->get_one_internship_course_detail(3);
        $acimage = FCPATH.CERT_PATH.'Attendance_Certificate.png';
        $data['acimage'] = $this->createimage($acimage);
        $data['record'] = $student;
        $html = view('pdfhtml/attendance_cert', $data);
        // echo $html;exit;
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
        $mpdf->Output('attendance_cert.pdf', 'I'); exit;
    }
    public function c_p_pdf(){ //cover page
        $student = $this->service_model->get_one_internship_course_detail(3);
        $html = view('pdfhtml/cover_page', ['record'=>$student]);
        // echo $html;exit;
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
        $mpdf->Output('cover_page.pdf', 'I'); exit;
    }
}