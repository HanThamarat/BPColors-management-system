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
            // 'edit' => $this->edit,
        ]);
    }
}
