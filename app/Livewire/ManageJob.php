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

    public function render()
    {
        return view('livewire.manage-job', [
            'getJob' => DB::table('job_cal')->get(),
        ]);
    }
}
