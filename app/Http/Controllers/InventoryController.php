<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Donor;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DataTables;
use DB;
class InventoryController extends Controller
{
    public function index()
    {
        return view('donations');
    }

    public function create()
    {
        //
    }

    public function donatenow($id){
        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $hasDonors_inInventory = Inventory::where('donor_id', $id)->get();

        foreach($hasDonors_inInventory as $hasDonor_inInventory){
            $count = $hasDonor_inInventory->count;
            $count_data = ++$count;
        }

        /*insert count*/
        if($hasDonors_inInventory->isEmpty()){
            $count_no = 1;
        }else{
            $count_no = $count_data;
        }

        $donor = Donor::find($id);


        $now = Carbon::now();
        $todaydate = $now->toDateString();

        $donation = new Inventory();
        $donation->count = $count_no;
        $donation->dod = $todaydate;
        $donation->status = '0';
        $donation->donor_id = $id;
        $donation->blood_id = $donor->blood_id;
        $donation->user_id = $authuser_id;
        $donation->save();

        return response()->json(['success'=>'Donation <b> SAVED </b> successfully.']);

    }

    public function store(Request $request)
    {
        $rules = [
            'donor'     => 'required',
            'dod'     => 'required',
        ];

        $customMessages = [
            'donor.required' => 'သွေးလှူဒါန်းသူနာမည်ရွေးပေးရန်လိုအပ်ပါသည်။',
            'dod.required' => 'သွေးလှူဒါန်းသည့်ရက်ဆွဲသိမ်းထားရန်လိုအပ်ပါသည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        $donorid = $request->donor;
        $dod = $request->dod;

        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $hasDonors_inInventory = Inventory::where('donor_id', $donorid)->get();

        foreach($hasDonors_inInventory as $hasDonor_inInventory){
            $count = $hasDonor_inInventory->count;
            $count_data = ++$count;
        }

        /*insert count*/
        if($hasDonors_inInventory->isEmpty()){
            $count_no = 1;
        }else{
            $count_no = $count_data;
        }

        $donor = Donor::find($donorid);

        $donation = new Inventory();
        $donation->count = $count_no;
        $donation->dod = $dod;
        $donation->status = '0';
        $donation->donor_id = $donorid;
        $donation->blood_id = $donor->blood_id;
        $donation->user_id = $authuser_id;
        $donation->save();

        return response()->json(['success'=>'Donation <b> SAVED </b> successfully.']);

    }

    public function show(Inventory $inventory)
    {
        //
    }

    public function edit(Inventory $inventory)
    {
        //
    }

    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    public function destroy(Inventory $inventory)
    {
        //
    }

    public function ongoingdonors(){

        return view('ongoingdonors');
    }

    public function getOngoingdonations(){
        $donors = Donor::with(['inventories' => function ($inventory) {
                $inventory->orderByRaw("CAST(count as Integer) DESC")->first();
                }])->get();

        $now = Carbon::now();
        $todaydate = $now->toDateString();
        $donorids =[];

        foreach ($donors as $donor) {
            $inventories = Inventory::where('donor_id',$donor->id)->orderByRaw("CAST(count as Integer) DESC")->get();

            if (!$inventories->isEmpty()) {
                $dod = Carbon::parse($inventories[0]->dod);
                $coming_dod = $dod->addMonths(2)->format('Y-m-d');

                    if ($coming_dod == $todaydate) {
                        $donorid = $donor->id;

                        array_push($donorids, $donorid);
                        // var_dump($donorid);
                    }
                

            }
        }

        if (count($donorids) < 0) {
            $data=null; 
        }else{
            $data = Donor::whereIn('id',$donorids)->get();

        }


        // dd($data);
        if($data){
            return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function(Donor $donor) {
                $data = '<span class="mmfont">'.$donor->user->name.'</span>';
                
                return $data;
            })
            ->addColumn('blood', function(Donor $donor) {
                $bloodsign = $donor->blood->status;
                $sign='';

                if ($bloodsign =='negative') {
                    $sign = ' - ';
                }
                $data = $sign.$donor->blood->type.'<span class="mmfont"> သွေး</span>';
                
                return $data;
            })
            ->addColumn('lastdate', function(Donor $donor) {
                $donor_id = $donor->id;

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("CAST(count as Integer) DESC")->get();


                if ($inventories->isEmpty()) {
                    $data = ' - ';
                }

                else{
                    $dod = \Carbon\Carbon::parse($inventories[0]->dod);

                    $lastdate = $dod->format('M d, Y');

                    $data = '<span class="mmfont">'.$lastdate.'</span>';

                }
                
                return $data;

            })
            ->addColumn('frequency', function(Donor $donor) {
                $donor_id = $donor->id;

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("CAST(count as Integer) DESC")->get();

                // dd($inventories->isEmpty());

                if ($inventories->isEmpty()) {
                    $count = '0';   
                }
                else{
                    $count = $inventories[0]->count;
                }

                $data = $count.'<span class="mmfont"> ကြိမ် </span>';
                
                return $data;
            })

            ->addColumn('action', function(Donor $donor){
                
                $btn = '<button type="button" class="btn btn-outline-danger btn-sm tooltips donateBtn" data-id="'.$donor->id.'">
                            <span class="mmfont">သွေးလှူမည်</span>

                            <i class="icofont-blood"></i>
                        </button>';

                return $btn;
            })
            ->rawColumns(['name','blood','lastdate','frequency', 'action'])
            ->make(true);
        }else{
            return response()->json(['draw'=>1,'data'=>[], 
                'recordsFiltered'=>0, 'recordsTotal'=>0
            ]);

        }
        
    }

    public function getDonations_bydate(Request $request){
        $s = $request->sdate;
        $e = $request->edate;

        $now = Carbon::now();
        $date = $now->toDateString(); 

        $startdate = Carbon::parse($s)->format('Y-m-d');
        $enddate = Carbon::parse($e)->format('Y-m-d');

        $data = Inventory::with('user','blood')
                    ->whereBetween('dod',[$startdate, $enddate])
                    ->get();

        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function(Inventory $inventory) {
                $data = '<span class="mmfont">'.$inventory->donor->user->name.'</span>';
                
                return $data;
            })
            ->addColumn('blood', function(Inventory $inventory) {
                $bloodsign = $inventory->donor->blood->status;
                $sign='';

                if ($bloodsign =='negative') {
                    $sign = ' - ';
                }
                $data = $sign.$inventory->donor->blood->type.'<span class="mmfont"> သွေး</span>';
                
                return $data;
            })
            ->addColumn('lastdate', function(Inventory $inventory) {
                $donor_id = $inventory->donor_id;

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("CAST(count as Integer) DESC")->get();

                $dod = \Carbon\Carbon::parse($inventories[0]->dod);

                $lastdate = $dod->format('M d, Y');

                $data = '<span class="mmfont">'.$lastdate.'</span>';
                
                return $data;
            })
            ->addColumn('frequency', function(Inventory $inventory) {

                $donor_id = $inventory->donor_id;

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("CAST(count as Integer) DESC")->get();

                $count = $inventories[0]->count;


                $data = $count.'<span class="mmfont"> ကြိမ် </span>';
                
                return $data;
            })

            ->rawColumns(['name','blood','lastdate','frequency'])
            ->make(true);
    }
}
