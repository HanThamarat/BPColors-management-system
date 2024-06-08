<?php

namespace App\Livewire;

use App\Models\claim;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\tbl_claim;
use App\Models\tbl_stock_technician;
use App\Models\tbl_wip;
use Illuminate\Support\Facades\Auth;

class CustomerScreen extends Component
{
    public $userId;
    public $userData;

    // detail_form
    public $date_cliam;
    public $date_carin;
    public $date_service;
    public $date_repair;
    public $date_send_next;
    public $cost_doit;
    public $cost_totel;
    public $cost_sparepart;
    public $date_firmins;
    public $firm_doit;
    public $firm_all;
    public $firm_sparepart;
    public $date_send_car;
    public $date_dms;
    public $date_ecliam;
    public $date_fecliam;
    public $date_transfer;
    public $exzept;
    public $invoice_no;
    public $date_bill;
    public $total_pay;
    public $bill_no;
    public $date_paybill;
    public $note_service;

    //cus_form
    public $cus_name;
    public $cus_phoneNumber;
    public $claim_status;
    public $except;
    public $color;
    public $clm_number;
    public $regiscar_number;
    public $car_brand;
    public $car_model;
    public $car_body_number;
    public $clm_recipient;
    public $policy_number;
    public $job_number;
    public $insurence;
    public $insurence_type;
    public $insurence_name;
    public $insurence_EMCS;
    public $work_type;
    public $status_repair;
    public $note;
    public $cus_resource;

    public $GetBrand;
    public $GetInsurances;

    public $FormCuspop;

    public $formType;
    
    public $wipDatas;

    public $date_send;

    public $evaluate_total;
    public $evaluate_job;
    public $evaluate_spares;

    // public $Inputs = [''];

    public $technician;


    public $popupForm = false;
    public $cus_tail = true;
    public $repair_tail = false;

    public $type_doit = [''];
    public $respon_name = [''];
    public $date_start = [''];
    public $date_stop = [''];
    public $cal_doit = [''];

    // alert 
    // public $alert;

    public function placeholder() {
        return view('components.cus-placehoder');
    }
    public function updateSumCost() {
        $this->cost_totel = number_format(($this->cost_doit + $this->cost_sparepart), 2);
    }
    public function updateSumFirm() {
        $this->firm_all = number_format(($this->firm_doit + $this->firm_sparepart), 2);
    }
    public function addInput()
    {
        $this->type_doit[] = '';
        $this->respon_name[] = '';
        $this->date_start[] = '';
        $this->date_stop[] = '';
        $this->cal_doit[] = '';
    }

    public function removeInput($index)
    {
        if(!empty($this->type_doit[$index]->no)) {
            DB::table('tbl_wip')->whereRaw("no = ?",[$this->type_doit[$index]->no])->delete();
        } else {
            // dd($this->type_doit[$index]);
            unset($this->type_doit[$index]);
            // $this->type_doit = array_values($this->type_doit);

            unset($this->respon_name[$index]);
            // $this->respon_name = array_values($this->respon_name);

            unset($this->date_start[$index]);
            // $this->date_start = array_values($this->date_start);

            unset($this->date_stop[$index]);
            // $this->date_stop = array_values($this->date_stop);

            unset($this->cal_doit[$index]);
            // $this->cal_doit = array_values($this->cal_doit);
        }
    }

    public function handledetail($tail_id) {
        if($tail_id == 1) {
            $this->repair_tail = true;
            $this->cus_tail = false;
        } else {
            $this->cus_tail = true;
            $this->repair_tail = false;
        }
    }

    public function mount() {
        if(session()->get('userID') === null) {
            return redirect()->route('showbp');
        }

        $this->userId = session()->get('userID');
        $this->technician = tbl_stock_technician::all();
        $no_claim = DB::table('tbl_claim')->where(['id' => $this->userId])->get()[0]->no_claim;
        $this->wipDatas = DB::table('tbl_wip')->where(['no_claimex' => $no_claim])->get();
        $this->GetBrand = DB::table('brand_car')->get();
        $this->GetInsurances = DB::table('tbl_insurance')->get();

        if (count($this->wipDatas) !== 0) {
            $this->type_doit = $this->wipDatas;
            $this->respon_name = $this->wipDatas;
            $this->date_start = $this->wipDatas;
            $this->date_stop = $this->wipDatas;
            $this->cal_doit = $this->wipDatas;
        }
    }

    public function insertDetail() {

        // dd($this->date_cliam, $this->date_carin);

        $this->validate([
            'date_cliam' => 'required:min:3',
            'date_carin' => 'required:min:3',
        ],
        [
            'date_cliam.required' => "กรุณากรอกวันที่เข้าเคลม",
            'date_carin.required' => "กรุณากรอกข้อมูล",
        ]);

        $response = DB::table('tbl_claim')->where(['id' => $this->userId])->get()[0];

        // dd([$this->date_repair,$response->car_job ]);

        if($this->date_repair !== null && $response->car_job !== null) {
            $dateplus = '';
            if($response->car_job === "L-เบา") {
                $dateplus = "+6 day";
            } else if($response->car_job === "M-กลาง") {
                $dateplus = "+14 day";
            } else if($response->car_job === "H1") {
                $dateplus = "+21 day";
            } else if($response->car_job === "H2") {
                $dateplus = "+35 day";
            } else if($response->car_job === "H3") {
                $dateplus = "+45 day";
            }
          
            $date_cal = $this->date_repair;
            $date_sent = date('Y-m-d', strtotime($dateplus, strtotime($date_cal)));

                DB::table('tbl_claim')->where(['id' => $this->userId])->update([
                    'date_cliam' => $this->date_cliam,
                    'date_carin' => $this->date_carin,
                    'date_service' => $this->date_service,
                    'date_repair' => $this->date_repair,
                    'date_send_next' => $this->date_send_next,
                    'cost_doit' => $this->cost_doit,
                    'cost_totel' => $this->cost_totel,
                    'cost_sparepart' => $this->cost_sparepart,
                    'date_firmins' => $this->date_firmins,
                    'firm_doit' => $this->firm_doit,
                    'firm_all' => $this->firm_all,
                    'firm_sparepart' => $this->firm_sparepart,
                    'date_send_car' => $this->date_send_car,
                    'date_dms' => $this->date_dms,
                    'date_ecliam' => $this->date_ecliam,
                    'date_fecliam' => $this->date_fecliam,
                    'exzept' => $this->exzept,
                    'invoice_no' => $this->invoice_no,
                    'date_bill' => $this->date_bill,
                    'total_pay' => $this->total_pay,
                    'bill_no' => $this->bill_no,
                    'date_paybill' => $this->date_paybill,
                    'note_service' => $this->note_service,
                    'date_send' => $date_sent,
                    'date_transfer' => $this->date_transfer,
                ]);

             $this->dispatch('alert', 
                type: 'success',
                title: 'บันทึกข้อมูลเสร็จสิ้น',
                position: 'center',
                timer: 1500
            );

            $this->popupForm = false;
        } else {
            $this->dispatch('alert', 
                type: 'error',
                title: 'กรุณาตรวจสอบประเภทงาน',
                position: 'center',
                timer: 1500
            );
            // dd('err');
        }
    }

    public function closePopup() {
        $this->popupForm = false;
    }

    public function openPopup($btn_id) {

        if ($btn_id === 0) {
            $this->formType = $btn_id;
            // use func getdata from database
            $this->getDataservice();
        } else {
            $this->formType = $btn_id;
        }
        
        $this->popupForm = true;
    }

    public function formRepair() {
        $response = DB::table('tbl_claim')->where(['id' => $this->userId])->get()[0];
        // $job[] = $response;
        // $res_job = DB::table('job_cal')->get()[0]->job_ptc;

        $validateform = $this->validate([
            'type_doit.*' => 'required:min:1',
            'respon_name.*' => 'required:min:1',
            'date_start.*' => 'required:min:1',
            'date_stop.*' => 'required:min:1',
        ]);

        $res_job = DB::table('job_cal')->get();

        foreach ($res_job as $res) {
            $job["{$res->job_name}"] = $res->job_ptc;
        }

        $user_id = Auth::user()->id;

        // dd($response->firm_doit);
        
        if ($response->firm_doit != '0.00') {
            if(count($this->wipDatas) === 0) {
                for($i = 0; $i < count($this->type_doit); $i++) {
                    if($this->type_doit !== "") {
                        if($response->firm_doit !== 0.00) {
                            $firm_doit = $response->firm_doit;
                            $cal_job = ((floatval($firm_doit)*floatval($job[$this->type_doit[$i]]))/floatval(count(array_keys($this->type_doit, $this->type_doit[$i]))));
                        }
                        tbl_wip::create([
                            'no_claimex' => $response->no_claim,
                            'type_doit' => $this->type_doit[$i],
                            'respon_name' => $this->respon_name[$i],
                            'date_start' => $this->date_start[$i],
                            'date_stop' => $this->date_stop[$i],
                            'cal_doit' => $cal_job,
                            'date_create' => now(),
                            'user_create' => $user_id
                        ]);
                    }
                }
                $this->popupForm = false;
                $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'เพิ่มรายการซ่อมสำเร็จ',
                    timer: 1500
                );
            } else {
                for ($i=0; $i < count($this->wipDatas); $i++) { 
                    // dd($this->type_doit);   
                    // dump($this->type_doit[$i]->type_doit);
                    // $res = DB::table('tbl_wip')->where(['no' => intval($this->wipData[$i]->no)])->get()[0]->no;
                    // dump($res);

                    if($response->firm_doit !== 0.00 || $response->firm_doit !== '') {
                        $firm_doit = $response->firm_doit;
                        $cal_job = ((floatval($firm_doit)*floatval($job[$this->type_doit[$i]->type_doit]))/floatval(count(array($this->type_doit, $this->type_doit[$i]))));
    
                        DB::table('tbl_wip')->where(['no' => intval($this->wipDatas[$i]->no)])->update([
                            'no_claimex' => $response->no_claim,
                            'type_doit' => $this->type_doit[$i]->type_doit,
                            'respon_name' => $this->respon_name[$i]->respon_name,
                            'date_start' => $this->date_start[$i]->date_start,
                            'date_stop' => $this->date_stop[$i]->date_stop,
                            'cal_doit' => $cal_job,
                            'date_create' => now(),
                            'user_create' => $user_id
                        ]);
                    }

                    if(count($this->type_doit) > count($this->wipDatas)) {
                        // dd($this->type_doit,  $this->respon_name, $this->date_start, $this->date_stop);
                        for($i = count($this->wipDatas); $i < count($this->type_doit); $i++) {
                            if($this->type_doit[$i] !== "") {
                                if($response->firm_doit !== 0.00) {
                                    $firm_doit = $response->firm_doit;
                                    $cal_job = ((floatval($firm_doit)*floatval($job[$this->type_doit[$i]]))/floatval(count(array($this->type_doit, $this->type_doit[$i]))));
                                }
                                $res = tbl_wip::create([
                                    'no_claimex' => $response->no_claim,
                                    'type_doit' => $this->type_doit[$i],
                                    'respon_name' => $this->respon_name[$i],
                                    'date_start' => $this->date_start[$i],
                                    'date_stop' => $this->date_stop[$i],
                                    'cal_doit' => $cal_job,
                                    'date_create' => now(),
                                    'user_create' => $user_id
                                ]);
                            } else {
                                $this->dispatch('alert',
                                    position: 'center',
                                    type: 'error',
                                    title: 'เพิ่มรายการซ่อมไม่สำเร็จ',
                                    timer: 1500
                                );
                            }
                        }
                        
                    }
                }
                $this->popupForm = false;

                 $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'เพิ่มรายการซ่อมสำเร็จ',
                    timer: 1500
                );
            }
        } else {
            // $this->popupForm = false; 

            $this->dispatch('alert',
                position: 'center',
                type: 'error',
                title: 'กรุณากรอกอนุมัติรวม',
                timer: 1500
            );
        }
    }

    public function getDataservice() {
        $response = tbl_claim::where(['id' => $this->userId])->get();

        $this->date_cliam = $response[0]->date_cliam;
        $this->date_send = $response[0]->date_send;
        $this->date_carin = $response[0]->date_carin;
        $this->date_service = $response[0]->date_service;
        $this->date_repair = $response[0]->date_repair;
        $this->date_send_next = $response[0]->date_send_next;
        $this->cost_doit = $response[0]->cost_doit;
        $this->cost_totel = $response[0]->cost_totel;
        $this->cost_sparepart = $response[0]->cost_sparepart;
        $this->date_firmins = $response[0]->date_firmins;
        $this->firm_doit = $response[0]->firm_doit;
        $this->firm_all = $response[0]->firm_all;
        $this->firm_sparepart = $response[0]->firm_sparepart;
        $this->date_send_car = $response[0]->date_send_car;
        $this->date_dms = $response[0]->date_dms;
        $this->date_ecliam = $response[0]->date_ecliam;
        $this->date_fecliam = $response[0]->date_fecliam;
        $this->exzept = $response[0]->exzept;
        $this->invoice_no = $response[0]->invoice_no;
        $this->date_bill = $response[0]->date_bill;
        $this->total_pay = $response[0]->total_pay;
        $this->bill_no = $response[0]->bill_no;
        $this->date_paybill = $response[0]->date_paybill;
        $this->note_service = $response[0]->note_service;
    }

    public function openFormCustomer() {
        $this->FormCuspop = true;

        $response = tbl_claim::where(['id' => $this->userId])->get();

        $this->clm_recipient = $response[0]->user_con;
        $this->clm_number = $response[0]->no_claim;
        $this->policy_number = $response[0]->no_policy;
        $this->job_number = $response[0]->no_job;
        $this->cus_name = $response[0]->cus_name;
        $this->cus_phoneNumber = $response[0]->cus_tel;
        $this->regiscar_number = $response[0]->no_regiscar;
        $this->car_brand = $response[0]->car_brand;
        $this->car_model = $response[0]->car_model;
        $this->car_body_number = $response[0]->car_chassis;
        $this->except = $response[0]->status_deduct;
        $this->insurence_type = $response[0]->insure_type;
        $this->cus_resource = $response[0]->cus_resource;
        $this->insurence = $response[0]->insure_source;
        $this->color = $response[0]->status_color;
        $this->work_type = $response[0]->car_job;
        $this->insurence_name = $response[0]->insure_name;
        $this->insurence_EMCS = $response[0]->emcs;
        $this->note = $response[0]->remark;
        $this->claim_status = $response[0]->payment_st;
    }

    public function closeFormCustomer() {
        $this->FormCuspop = false;
    }

    public function saveFormCustomer() {
        tbl_claim::where(['id' => $this->userId])->update([
            'no_claim' => $this->clm_number,
            'no_policy' => $this->policy_number,
            'no_job' => $this->job_number,
            'cus_name' => $this->cus_name,
            'cus_tel' => $this->cus_phoneNumber,
            'no_regiscar' => $this->regiscar_number,
            'car_brand' => $this->car_brand,
            'car_model' => $this->car_model,
            'car_chassis' => $this->car_body_number,
            'status_deduct' => $this->except,
            'insure_type' => $this->insurence_type,
            'cus_resource' => $this->cus_resource,
            'insure_source' => $this->insurence,
            'status_color' => $this->color,
            'car_job' => $this->work_type,
            'insure_name' => $this->insurence_name,
            'emcs' => $this->insurence_EMCS,
            'remark' => $this->note,
            'payment_st' => $this->claim_status,
            'user_con' => $this->clm_recipient,
        ]);

        $this->dispatch('alert',
            position: 'center',
            type: 'success',
            title: 'บันทึกข้อมูล BP เสร็จสิ้น',
            timer: 1500
        );

        $this->FormCuspop = false;
    }

    public function render() {
        if(session()->get('userID') === null) {
            redirect()->route('showbp');
        }

        $no_claim = DB::table('tbl_claim')->where(['id' => session()->get('userID')])->get()[0]->no_claim;
        // $this->type_doit = DB::table('tbl_wip')->whereRaw("no_claimex = '". $no_claim ."'")->get();

        return view('livewire.customer-screen', [
            'getUserData' => DB::table('tbl_claim')->where(['id' => session()->get('userID')])->get()[0],
            'wipData' => DB::table('tbl_wip')->whereRaw("no_claimex = '". $no_claim ."'")->get(),
            'getJob' => DB::table('job_cal')->get(),
            'userdata_pa' => DB::table('users')
            ->selectRaw("id ,name")
            ->whereRaw("role = 'PA' AND status = 'active' ")
            ->get(),
        ]);
    }
}
