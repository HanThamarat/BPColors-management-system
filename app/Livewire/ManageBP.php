<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\tbl_claim;
use App\Models\brand_car;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function Laravel\Prompts\error;
use function Laravel\Prompts\table;

use Carbon\Carbon;

class ManageBP extends Component
{

    //loading variable
    public $active = true;

    // get value from form
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

    // get data from database
    public $GetBrand, $GetInsurances, $GetClaim, $numClaim;

    public function createClaim() {

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d h:i:s');

        $dateWork = '';

        $this->active = false;

        $validateData = $this->validate([
            'cus_name' => 'required|min:3',
            'cus_phoneNumber' => 'required|min:3',
            'claim_status' => 'required',
            'clm_number' => 'required|min:5',
            'regiscar_number' => 'required|min:3',
            'car_brand' => 'required',
            'car_model' => 'required|min:3'
        ],
        [
            'cus_name.required' => 'กรุณากรอกชื่อของลูกค้า',
            'cus_name.min:3' => 'กรุณากรอกชื่อที่ถูกต้อง',
            'cus_phoneNumber.required' => 'กรุณากรอกเบอร์โทรของลูกค้า',
            'claim_status.required' => 'กรุณาเลือกสถานะ',
            'clm_number.required' => 'กรุณากรอกเลขที่เคลม',
            'clm_number.min:5' => 'กรุณากรอกเลขที่เคลมที่ถุกต้อง',
            'regiscar_number.required' => 'กรุณากรอกทะเบียนรถ',
            'regiscar_number.min:3' => 'กรุณากรอกทะเบียนรถที่ถูกต้อง',
            'car_brand.required' => 'กรุณาเลือกยี่ห้อรถ',
            'car_model.required' => 'กรุณากรอกรุ่นรถ',
        ]);

        $tableName = 'tbl_claim';
        $table = DB::table($tableName);
        $check_on_claim = $table->where([ 'no_claim' => $this->clm_number ])->count();
        if($check_on_claim === 0) {
            $respose = DB::insert("INSERT INTO {$tableName} (
                no_claim, 
                no_policy,
                no_job,
                cus_name,
                cus_tel,
                no_regiscar,
                car_brand,
                car_model,
                car_chassis,
                status_deduct,
                insure_type,
                cus_resource,
                insure_source,
                status_color,
                car_job,
                insure_name,
                emcs,
                remark,
                payment_st,
                date_create,
                user_con
                ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[
                $this->clm_number,
                $this->policy_number,
                $this->job_number,
                $this->cus_name,
                $this->cus_phoneNumber,
                $this->regiscar_number,
                $this->car_brand,
                $this->car_model,
                $this->car_body_number,
                $this->except,
                $this->insurence_type,
                $this->cus_resource,
                $this->insurence,
                $this->color,
                $this->work_type,
                $this->insurence_name,
                $this->insurence_EMCS,
                $this->note,
                $this->claim_status,
                $formattedDate,
                $this->clm_recipient
            ]);

                $this->reset([
                    'clm_number',
                    'policy_number',
                    'job_number',
                    'cus_name',
                    'cus_phoneNumber',
                    'regiscar_number',
                    'car_brand',
                    'car_model',
                    'car_body_number',
                    'except',
                    'insurence_type',
                    'cus_resource',
                    'insurence',
                    'color',
                    'work_type',
                    'insurence_name',
                    'insurence_EMCS',
                    'note',
                    'claim_status',
                    'clm_recipient'
                ]);

                if($respose === true) {
                    $this->dispatch('alert',
                        title: 'เพิ่มข้อมูล BP เรียบร้อย',
                        type: 'success',
                        position: 'center',
                        timer: 1500
                    );

                    $lastInsertId = DB::getPdo()->lastInsertId();

                    session()->put('userID', $lastInsertId);
                    return redirect()->route('cusPage');
                } else {
                    $this->dispatch('alert',
                        title: 'เพิ่มข้อมูล BP ไม่สมบูร',
                        type: 'error',
                        position: 'center',
                        timer: 1500
                    );
                }
        } else {
            $this->active = true;
        }
    }

    public function mount()
    {
        $this->GetBrand = DB::table('brand_car')->get();
        $this->GetInsurances = DB::table('tbl_insurance')->whereRaw("flag = 'yes'")->get();
        $this->GetClaim = DB::table('tbl_claim')->get();
        $this->numClaim = DB::table('tbl_wip')->where(['no_claimex' => 'no_claim'])->count();
    }

    public function redirects($userId) {
        session()->put('userID', $userId);
        return redirect()->route('cusPage');
    }

    public function render()
    {
        return view('livewire.manage-b-p', [
            "userdata_pa" => DB::table('users')
            ->selectRaw("id ,name")
            ->whereRaw("role = 'PA' AND status = 'active' ")
            ->get(),
        ]);
    }
}
