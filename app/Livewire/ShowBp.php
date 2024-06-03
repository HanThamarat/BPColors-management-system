<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\tbl_claim;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ShowBp extends Component
{
    use WithPagination;

    // public $GetClaim;
    public $numClaim;
    public $search;
    
    public $fromdate;
    public $todate;

    public $claim_st;

    public function placeholder() {
        return view('components.placehoder');
    }

    public function mount() {
        // $this->GetClaim = DB::table('tbl_claim')->paginate(10);

        $this->numClaim = DB::table('tbl_wip')->where(['no_claimex' => 'no_claim'])->count();
    }

    public function redirects($userId) {
        session()->put('userID', $userId);
        return redirect()->route('cusPage');
    }

    public function deleteRow($claim_id) {

        // $this->dispatch('confirmAlert',
        //     title: 'แน่ใจหรือไม่',
        //     type: 'warning',
        //     text: 'คุณแน่ใจหรือไม่จะลบ',
        //     textBtn: 'Yes, delete',
        //     titleCon: 'เสร็จสิ้น',
        //     textCcon: 'ลบเสร็จสิ้น',
        //     typeCon: 'success'
        // );

        $response = DB::table('tbl_claim')->whereRaw("id = '". $claim_id ."'")->delete();

        if ($response >= 1) { 
            $this->dispatch('alert', 
                type: 'success',
                title: 'ลบข้อมูลเสร็จสิ้น',
                position: 'center',
                timer: 1500
            );
        } else {
            $this->dispatch('alert', 
                type: 'error',
                title: 'ลบข้อมูลไม่สำเร็จ',
                position: 'center',
                timer: 1500
            );
        }
    }

    public function render()
    {
        return view('livewire.show-bp', [
            'GetClaim' => DB::table('tbl_claim')->whereRaw("date_cliam between '". $this->fromdate ."' and '". $this->todate ."' AND no_claim like '%". $this->search ."%'")->paginate(5)
        ]);
    }
}
