<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use App\Traits\RazorpayTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Internship extends BaseController
{
    use RazorpayTrait;

    public $data;
    public $commonmodel;
    public $adminmodel;
    private $servicemodel;
    public function __construct()
    {
        $this->data['title'] = 'Admin-Internship';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->servicemodel = model('App\Models\Service_model', false);
    }
    
    public function index($ie_id=null)
    {
        if($this->request->getMethod() == 'post'){
            session()->set(
                'intern_student_search',
                trim($this->request->getPost('search'))
            ); 
            session()->set(
                'intern_student_status', $this->request->getPost('status')
            ); 
            session()->set(
                'intern_course_status', $this->request->getPost('cstatus')
            ); 
        }
        // $this->servicemodel->get_internship_students();exit;
        $totRecord = $this->servicemodel->get_internship_students('', $count=1);
        $rec_limit = 10;
        $page_config = array(
            'tot_record' => $totRecord,
            'rec_limit' => $rec_limit,
            'btn_limit' => 5,
            'current_page' => (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:0,
            'url' => current_url(),
            'url_param' => 'page',
            'colspan' => 13,
        );
        $cp_data = custom_pagination($page_config);
        // print_r($cp_data); exit;
        $limit = $cp_data['limit'];
        $offset = $cp_data['offset'];
        $this->data['pagination'] = $cp_data['pagination_html'];
        $this->data['records'] = $this->servicemodel->get_internship_students('','',$limit, $offset);
        if($ie_id == null && isset($this->data['records'][0]->ie_id)){
            $ie_id = $this->data['records'][0]->ie_id;
        }
        $this->data['record'] = $this->servicemodel->get_internship_students($ie_id);
        $this->data['courses'] = $this->servicemodel->get_applied_internship_courses($ie_id);
        $this->data['caption'] = $cp_data['caption'];
        return view("admin/internship/internstulist",$this->data);
        
    }
    public function reset_search(){
        session()->remove('intern_student_search');
        session()->remove('intern_student_status');
        session()->remove('intern_course_status');

        return redirect()->to(base_url('admin/intern-students'));
    }
    public function refund_amount(){
        // print_r($_POST);
        if($this->request->getMethod() == 'post'){
            $ia_id = $this->request->getPost('ia_id');
            $amount    = $this->request->getPost('amount');
            $reason    = $this->request->getPost('reason');

            $internApp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ia_id'=>$ia_id]);
            if(!empty($internApp)){
                $payment_id = $internApp->razor_payment_id;
                $razorConfig['payment_id'] = $payment_id;
                $razorConfig['amount'] = (int) $amount * 100;
                $refund = $this->refundPayment($razorConfig);

                if(isset($refund['status']) && $refund['status'] == true){
                    $data = $refund['data'];
                    $iaUpdateData = array(
                        'status' => 5,
                        'refund_id' => $data['id'],
                        'refund_amount' => $amount,
                        'refund_status' => $data['status'],
                        'refund_reason' => $reason,
                        'refund_date' => date('Y-m-d H:i:s', $data['created_at']),

                    );
                    $updated = $this->commonmodel->updateRecord('tbl_internship_applications', $iaUpdateData, ['ia_id'=>$ia_id]);
                    if($updated){
                        $this->commonmodel->updateRecord('tbl_payment_transaction', ['payment_status'=>'Refund'], ['ia_id'=>$ia_id,'razor_payment_id'=>$payment_id]);
                    }
                    session()->setFlashdata(['message'=>'Refund has been initiated successfully. Please click "Refresh Status" to sync the latest refund status from the payment gateway.','type'=>'success']);

                }else{
                    $message = $refund['message'];
                    session()->setFlashdata(['message'=>$message,'type'=>'danger']);
                }
            }
        }
        return redirect()->to(base_url('admin/intern-students'));
    }
    public function update_refund_status($ia_id){
        $internApp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ia_id'=>$ia_id]);
        $ie_id = $internApp->ie_id ?? '';
        if(!empty($internApp) && $internApp->refund_id != null){
            $refund_id = $internApp->refund_id;
            $refund = $this->refund_status($refund_id);

            if(isset($refund['status']) && $refund['status'] == true){
                $data = $refund['data'];
                $iaUpdateData = array(
                    'refund_status' => $data['status'],
                    'refund_updated' => date('Y-m-d H:i:s'),

                );
                $updated = $this->commonmodel->updateRecord('tbl_internship_applications', $iaUpdateData, ['ia_id'=>$ia_id]);
                
                session()->setFlashdata(['message'=>'The refund status has been updated successfully.','type'=>'success']);

            }else{
                $message = $refund['message'];
                session()->setFlashdata(['message'=>$message,'type'=>'danger']);
            }
        }
        return redirect()->to(base_url('admin/intern-students/'.$ie_id));
    }
    public function intern_export(){
        $students = $this->servicemodel->get_all_internship_application();
        // echo '<pre>';print_r($apps);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Sheet Name
        $sheet->setTitle('Students');
         // Heading
        $sheet->setCellValue('A1', 'Student ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Phone');
        $sheet->setCellValue('E1', 'University Roll No');
        $sheet->setCellValue('F1', 'University Reg No');
        $sheet->setCellValue('G1', 'Class');
        $sheet->setCellValue('H1', 'MJC');
        $sheet->setCellValue('I1', 'Session');
        $sheet->setCellValue('J1', 'Semester');
        $sheet->setCellValue('K1', 'College');
        $sheet->setCellValue('L1', 'Internship Course');
        $sheet->setCellValue('M1', 'Attendance');
        $sheet->setCellValue('N1', 'Amount');
        $sheet->setCellValue('O1', 'Payment Status');
        $sheet->setCellValue('P1', 'Result');
        $sheet->setCellValue('Q1', 'Grade');
        $sheet->setCellValue('R1', 'Certificate No');
        $sheet->setCellValue('S1', 'Status');
        $sheet->setCellValue('T1', 'Registration Date');
        $sheet->setCellValue('U1', 'Completion Date');

        // Heading Style
        $sheet->getStyle('A1:U1')->getFont()->setBold(true);

        // Data
        $row = 2;

        foreach ($students as $student) {

            $status = $this->get_intern_program_status($student->status);

            $sheet->setCellValue('A' . $row, $student->enroll_id);
            $sheet->setCellValue('B' . $row, $student->stu_name);
            $sheet->setCellValue('C' . $row, $student->email);
            $sheet->setCellValue('D' . $row, $student->phone);
            $sheet->setCellValue('E' . $row, $student->uni_roll_no);
            $sheet->setCellValue('F' . $row, $student->uni_reg_no);
            $sheet->setCellValue('G' . $row, $student->class);
            $sheet->setCellValue('H' . $row, $student->sub_name);
            $sheet->setCellValue('I' . $row, $student->session);
            $sheet->setCellValue('J' . $row, $student->semester);
            $sheet->setCellValue('K' . $row, $student->college_name);
            $sheet->setCellValue('L' . $row, $student->ic_name);
            $sheet->setCellValue('M' . $row, $student->attendence);
            $sheet->setCellValue('N' . $row, $student->amount);
            $sheet->setCellValue('O' . $row, $student->payment_status);
            $sheet->setCellValue('P' . $row, $student->result);
            $sheet->setCellValue('Q' . $row, $student->grade);
            $sheet->setCellValue('R' . $row, $student->cert_no);
            $sheet->setCellValue('S' . $row, $status);
            $sheet->setCellValue('T' . $row, $student->added_at);
            $sheet->setCellValue('U' . $row, $student->completion_date);

            $row++;
        }

        // Auto width
        foreach (range('A', 'U') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Download
        $filename = 'students_' . date('Y-m-d_H-i-s') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        // Output buffer clear
        if (ob_get_length()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        exit;
    }
    private function get_intern_program_status($status){
        switch ($status){
            case 1:
                return 'Payment Completed';
                break;
            case 2:
                return 'Exam In Progress';
                break;
            case 3:
                return 'Exam Completed (Passed)';
                break;
            case 4:
                return 'Exam Completed (Failed)';
                break;
            case 5:
                return 'Payment Refund';
                break;
            default:
                return 'Application Incomplete';
                break;
        }
    }
}