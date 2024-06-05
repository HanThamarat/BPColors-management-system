<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ManageJob extends Component
{
    public $job_name;
    public $job_ptc;
    public $edit = false;
    public $jobId;
    public $job_name_edit;
    public $job_cal_edit;

    public $user_PA = false;
    public $user_original = true;

    public $date_col_from;
    public $date_col_to;

    public $showDetail = false;

    public $cal_up = [];

    public function placeholder() {
        return view('components.manage-placholder');
    }

    public function showdt() {
        if ($this->showDetail == false) {
            $this->showDetail = true;
        } else {
            $this->showDetail = false;
        }
    }

    public function handledetail($tail_id) {
        if($tail_id == 1) {
            $this->user_PA = true;
            $this->user_original = false;
        } else {
            $this->user_original = true;
            $this->user_PA = false;
        }
    }

    public function create() {
        $validate = $this->validate([
            'job_name' => 'required|min:3',
            'job_ptc' => 'required|min:3',
        ]);

        $res = DB::table('job_cal')->insert([
            "job_name" => $this->job_name,
            "job_ptc" => $this->job_ptc,
        ]);

        if ($res == true) {
            $this->reset('job_name', 'job_ptc');
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'เพิ่มผานสำเร็จ',
                timer: 1500
            );
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'error',
                title: 'เพิ่มงานไม่สำเร็จ',
                timer: 1500
            );
        }
    }

    public function manage($jobId) {
        $this->edit = true;
        $this->jobId = $jobId;

        $res_job = DB::table('job_cal')->whereRaw("id = '". $jobId ."' ")->get()[0];

        $this->job_name_edit = $res_job->job_name;
        $this->job_cal_edit = $res_job->job_ptc;
    }

    public function saveEdit() {
        $res_up = DB::table('job_cal')->whereRaw("id = '". $this->jobId ."' ")->update([
            "job_name" => $this->job_name_edit,
            "job_ptc" => $this->job_cal_edit,
        ]);

        if($res_up == '1') {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'อัพเดทข้อมูลสำเร็จ',
                timer: 1500
            );
            $this->edit = false;
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'อัพเดทข้อมูลไม่สำเร็จ',
                timer: 1500
            );
            $this->edit = false;
        }
    }

    public function closeManage() {
        $this->edit = false;
    }

    public function delete($jobId) {
        $res = DB::table('job_cal')->where('id', $jobId)->delete();

        if($res == '1') {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                timer: 1500
            );
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'ลบข้อมูลไม่สำเร็จ',
                timer: 1500
            );
        }
    }

    public function updatajobCal() {

        $res_job = DB::table('job_cal')->get();

        foreach ($res_job as $res) {
            $job["{$res->job_name}"] = $res->job_ptc;
        }


        $response = DB::table('tbl_claim')->whereRaw("date_dms between '2024-05-01' AND '2024-05-31'")->get();

        foreach ($response as $row) {
            $res_wip = DB::table("tbl_claim")
            ->selectRaw('tbl_wip.*')
            ->join('tbl_wip','tbl_claim.no_claim','=','tbl_wip.no_claimex')
            ->whereRaw("no_claimex = '". $row->no_claim ."' AND type_doit <> ''")->get();
            for ($i=0; $i < count($res_wip); $i++) { 
                if($row->firm_doit !== 0.00) {
                    $firm_doit = $row->firm_doit;
                    $cal_job = ((floatval($firm_doit)*floatval($job[$res_wip[$i]->type_doit]))/floatval(count(array($res_wip[$i]->type_doit))));
    
                    DB::table('tbl_wip')->where(['no' => intval($res_wip[$i]->no)])->update([
                        'cal_doit' => $cal_job,
                        'date_create' => now(),
                    ]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.manage-job', [
            'getJob' => DB::table('job_cal')->get(),
            'count_job' => DB::table('job_cal')->selectRaw("COUNT(id) AS COUNT_JOB")->get()[0],
        ]);
    }
}
