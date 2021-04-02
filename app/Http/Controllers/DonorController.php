<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Blood;
use App\Models\User;
use App\Models\Inventory;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use DataTables;
use Auth;

class DonorController extends Controller
{
    public function index()
    {
        $positivebloods = Blood::where('status','positive')->get();
        $negativebloods = Blood::where('status','negative')->get();

        return view('donors', compact('negativebloods', 'positivebloods'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'phone'     => 'required',
            'blood'     => 'required',
            'address'     => 'required',

            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ];

        $customMessages = [
            'phone.required' => 'ဖုန်းနံပါတ်ဖြည့်သွင်းရန်လိုအပ်ပါသည်။',
            'blood.required' => 'သွေးလှူဒါန်းသူ၏သွေးအမျိုးအစားသိမ်းထားရန်လိုအပ်ပါသည်။',
            'address.required' => 'နေရပ်လိပ်စာဖြည့်သွင်းရန်လိုအပ်ပါသည်။',

            'name.required' => 'သွေးလှူဒါန်းသူ၏နာမည်လိုအပ်ပါသည်။',
            'name.max' => 'နာမည်မှာ သတ်မှတ်ထားသောအရေအတွက်ထက်ကျော်လွန်နေပါသည်။',

            'email.required' => 'အီးမေးလ်လိုအပ်ပါသည်။',
            'email.max' => 'အီးမေးလ်မှာသတ်မှတ်ထားသောအရေအတွက်ထက်ကျော်လွန်နေပါသည်။',
            'email.unique' => 'အီးမေးလ်မှာထပ်နေသည်',
            
            'password.required' => 'စကားဝှက်လိုအပ်ပါသည်။',
            'password.min' => 'စကားဝှက်မှာအနည်းဆုံးစာလုံး ၈ လုံးပါရမည်။'

        ];

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $dob = $request->dob;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $blood = $request->blood;
        $address = $request->address;

        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $user->assignRole('Donor');

        $donor = new Donor();
        $donor->dob = $dob;
        $donor->phone = $phone;
        $donor->address = $address;
        $donor->blood_id = $blood;
        $donor->user_id = $user->id;
        $donor->created_id = $authuser_id;
        $donor->save();

        return response()->json(['success'=>'Donor <b> SAVED </b> successfully.']);


    }

    public function show(Donor $donor)
    {
        //
    }

    public function edit(Donor $donor)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $name = $request->name;
        $dob = $request->dob;
        $phone = $request->phone;
        $blood = $request->blood;
        $address = $request->address;

        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $donor = Donor::find($id);
        $donor->dob = $dob;
        $donor->phone = $phone;
        $donor->address = $address;
        $donor->blood_id = $blood;
        $donor->created_id = $authuser_id;
        $donor->save();

        $donor_user = $donor->user->id;

        $user = User::find($donor_user);
        $user->name = $name;
        $user->save();

        
        return response()->json(['success'=>'Donor <b> SAVED </b> successfully.']);
    }

    public function destroy(Donor $donor)
    {
        $donor->forceDelete();

        return response()->json(['success'=>'Donor <b> DELETED </b> successfully.']);
    }

    public function getlistData(){
        $donors = Donor::with('user')->latest()->get();

        return $donors;
    }

    public function getlistABData(Request $request)
    {
        $bloodids = [7,8];

        $data = Donor::whereIn('blood_id', $bloodids)->get();

        return $this->bloodDatatable($data);
    }

    public function getlistOData(Request $request)
    {
        $bloodids = [1,2];

        $data = Donor::whereIn('blood_id', $bloodids)->get();

        return $this->bloodDatatable($data);
        
    }

    public function getlistAData(Request $request)
    {
        $bloodids = [3,4];

        $data = Donor::whereIn('blood_id', $bloodids)->get();

        return $this->bloodDatatable($data);

    }
    
    public function getlistBData(Request $request)
    {
        $bloodids = [5,6];

        $data = Donor::whereIn('blood_id', $bloodids)->get();

        return $this->bloodDatatable($data);

    }

    public function bloodDatatable($data){
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

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("count DESC")->get();


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

                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("count DESC")->get();

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
            ->addColumn('user', function(Donor $donor) {
                $data = '<span class="mmfont"> By'.$donor->createduser->name.'</span>';
                
                return $data;
            })

            ->addColumn('action', function(Donor $donor){
                $donorname = $donor->user->name;

                $bloodsign = $donor->blood->status;
                $sign='';

                if ($bloodsign =='negative') {
                    $sign = ' - ';
                }
                $blood = $sign.$donor->blood->type;

                $doborigin = \Carbon\Carbon::parse($donor->dob);
                $dob = $doborigin->format('M d, Y');

                $donor_id = $donor->id;
                $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("count DESC")->get();

                if ($inventories->isEmpty()) {
                    $lastdate = ' - ';
                }

                else{
                    $dod = \Carbon\Carbon::parse($inventories[0]->dod);

                    $lastdate = $dod->format('M d, Y');
                }


                if ($inventories->isEmpty()) {
                    $count = '0';   
                }
                else{
                    $count = $inventories[0]->count;
                }

                $address = $donor->address;
                $phone = $donor->phone;


                $dods_arr=[];
                foreach ($inventories as $inventory) {
                    $dod = \Carbon\Carbon::parse($inventory->dod);
                    $dateofdonation = $dod->format('M d, Y');

                    array_push($dods_arr,  $dateofdonation);

                }

                $dods=implode("|",$dods_arr);

                $donorid= $donor->id;

                $btn = '<button type="button" class="btn btn-outline-info btn-sm detailBtn tooltips" data-name="'.$donorname.'" data-blood="'.$blood.'" data-dob="'.$dob.'" data-lastdate="'.$lastdate.'" data-count="'.$count.'" data-address="'.$address.'" data-dods="'.$dods.'" data-phone="'.$phone.'">
                            <span class="mmfont">အသေးစိတ်ကြည့်ရန်</span>
                            <i class="icofont-info"></i>
                        </button>';

                $btn = $btn.'<button type="button" class="btn btn-outline-warning btn-sm tooltips editBtn" data-donorid="'.$donorid.'" data-name="'.$donorname.'" data-dob="'.$donor->dob.'" data-address="'.$address.'" data-phone="'.$phone.'" data-bloodsign="'.$bloodsign.'" data-bloodid="'.$donor->blood_id.'">
                            <span class="mmfont">ပြင်ဆင်ရန်</span>

                            <i class="icofont-ui-edit"></i>
                        </button>';

                $btn = $btn.'<button type="button" class="btn btn-outline-danger btn-sm tooltips deleteBtn" data-donorid="'.$donorid.'">
                            <span class="mmfont">ဖျက်ဆီးမည်</span>

                            <i class="icofont-close"></i>
                        </button>';

                return $btn;
            })
            ->rawColumns(['name','blood','lastdate','frequency', 'user', 'action'])
            ->make(true);
    }
}
