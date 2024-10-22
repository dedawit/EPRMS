<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function index(){
        return view('auth.login');
    }
    public function index_employees(User $user){
        $otherUsers = User::where('id', '!=', $user->id)
                  ->whereNotNull('role');

        if (request()->has('search')) {
            $otherUsers->where('first_name', 'like', '%' . request()->get('search') . '%');

        }

        $otherUsers = $otherUsers->get();

        return view('admin.employee-list', compact('user', 'otherUsers'));
    }

    public function authenticate(){
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8',

            ],

        );
        if (auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {

            $user = User::where('email', $validated['email'])->first();
            request()->session()->regenerate();
            $checker = $user->role;
            switch ($user->role) {
                case 'system_admin':
                    return redirect()->route('admin.employee-list',compact('user'));
                    break;
                case 'receptionist':
                    return redirect()->route('receptionist.patient-list',compact('user'));
                    break;
                case 'doctor':
                    return redirect()->route('doctor.triage-list', compact('user'));
                    break;
                case 'laboratory_technologist':
                    return redirect()->route('lab.patient-list',compact('user'));
                    break;
            }
        }
        return redirect()
        ->route('login')
        ->withErrors([
            'email' => 'no matching email and password',
        ]);

    }

    public function view(){
        return view('admin.create-account');
    }

    public function show(User $user){
        return view('admin.create-account', compact('user'));


    }

    public function show_patient(User $user){
        return view('receptionist.create-account', compact('user'));


    }

    public function edit(User $user, User $other){
        return view("admin.edit-account", compact('user', 'other'));

    }

    public function edit_patient(User $user, User $other){
        return view("receptionist.edit-account", compact('user', 'other'));

    }
    public function store(User $user){

        $request = request();
        $validated = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'gname' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'region' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'zone' => 'required',
                'woreda' => 'required',
                'ketena' => 'required',
                'kebele' => 'required',
                'house_number' => 'required',
                'emergency_name' => 'required',
                'emergency_phone' => 'required',
                'file-name' => 'required',
            ]);
        $filePath=null;
        if (request()->hasFile('file-name')) {

            $file = request()->file('file-name');
            $uniqueFolderName = date('YmdHis') . '_' . uniqid();
            $filePath = $file->storeAs('my_account/' . $uniqueFolderName, $file->getClientOriginalName(), 'public');
        }


        $data = User::create([
            'first_name'=> $request->fname,
            'father_name'=> $request->lname,
            'password'=>Hash::make("12345678"),
            'grand_father_name'=> $request->gname,
            'email'=>$request->email,
            'gender'=> $request->gender,
            'date_of_birth'=> $request->dob,

            'region'=>$request->region,
            'zone'=>$request->zone,
            'woreda'=>$request->woreda,
            'ketena'=>$request->ketena,
            'kebele'=>$request->kebele,
            'house_number'=>$request->house_number,
            'phone'=>$request->phone,
            'emergency_name'=>$request->emergency_name,
            'emergency_phone'=>$request->emergency_phone,

            'role'=>$request->role,
            'profile'=>$filePath,


        ]);
        return redirect()->route('admin.employee-list', compact('user'))->with('success','Account created successfully.');
     }

     public function store_patient(User $user){

        $request = request();
        $validated = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'gname' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'region' => 'required',

                'email' => 'email|unique:users,email',
                'zone' => 'required',
                'woreda' => 'required',
                'ketena' => 'required',
                'kebele' => 'required',
                'house_number' => 'required',
                'emergency_name' => 'required',
                'emergency_phone' => 'required',

            ]);





        $data = User::create([
            'first_name'=> $request->fname,
            'father_name'=> $request->lname,
            'grand_father_name'=> $request->gname,
            'email'=>$request->email,
            'gender'=> $request->gender,
            'date_of_birth'=> $request->dob,

            'region'=>$request->region,
            'zone'=>$request->zone,
            'woreda'=>$request->woreda,
            'ketena'=>$request->ketena,
            'kebele'=>$request->kebele,
            'house_number'=>$request->house_number,
            'phone'=>$request->phone,
            'emergency_name'=>$request->emergency_name,
            'emergency_phone'=>$request->emergency_phone,

            'position'=>false,



        ]);
        return redirect()->route('receptionist.patient-list', compact('user'))->with('success','Account created successfully.');
     }

     public function update(User $user, User $other)
    {
        $request = request();
        $validated = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'gname' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'region' => 'required',
                'role' => 'required',
                'email' => 'required|email',
                'zone' => 'required',
                'woreda' => 'required',
                'ketena' => 'required',
                'kebele' => 'required',
                'house_number' => 'required',
                'emergency_name' => 'required',
                'emergency_phone' => 'required',

            ]);

        if (request()->hasFile('file-name')) {
            $file = request()->file('file-name');
            if ($other->profile) {
                $directoryPath = dirname($other->profile);
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
            $uniqueFolderName = date('YmdHis') . '_' . uniqid();
            $filePath = $file->storeAs('my_account/' . $uniqueFolderName, $file->getClientOriginalName(), 'public');
            $other->profile = $filePath;
        }


        $other->{'first_name'} = $validated['fname'];
        $other->{'father_name'} = $validated['lname'];
        $other->{'grand_father_name'} = $validated['gname'];
        $other->{'email'} = $validated['email'];
        $other->{'gender'} = $validated['gender'];
        $other->{'date_of_birth'} = $validated['dob'];
        $other->{'region'} = $validated['region'];

        $other->{'zone'} = $validated['zone'];
        $other->{'woreda'} = $validated['woreda'];
        $other->{'ketena'} = $validated['ketena'];
        $other->{'kebele'} = $validated['kebele'];
        $other->house_number = $validated['house_number'];
        $other->{'phone'} = $validated['phone'];
        $other->{'role'} = $validated['role'];
        $other->{'emergency_name'} = $validated['emergency_name'];
        $other->{'emergency_phone'} = $validated['emergency_phone'];


        $other->update();
        return redirect()->route('admin.edit-employee', compact('user', 'other'))->with('success', 'Account updated successfully!');
    }
     public function update_receptionist(User $user, User $other)
    {
        $request = request();

        $validated = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'gname' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'region' => 'required',

                'email' => 'required|email',
                'zone' => 'required',
                'woreda' => 'required',
                'ketena' => 'required',
                'kebele' => 'required',
                'house_number' => 'required',
                'emergency_name' => 'required',
                'emergency_phone' => 'required',

            ]);




        $other->{'first_name'} = $validated['fname'];
        $other->{'father_name'} = $validated['lname'];
        $other->{'grand_father_name'} = $validated['gname'];
        $other->{'email'} = $validated['email'];
        $other->{'gender'} = $validated['gender'];
        $other->{'date_of_birth'} = $validated['dob'];
        $other->{'region'} = $validated['region'];

        $other->{'zone'} = $validated['zone'];
        $other->{'woreda'} = $validated['woreda'];
        $other->{'ketena'} = $validated['ketena'];
        $other->{'kebele'} = $validated['kebele'];
        $other->house_number = $validated['house_number'];
        $other->{'phone'} = $validated['phone'];
        $other->{'emergency_name'} = $validated['emergency_name'];
        $other->{'emergency_phone'} = $validated['emergency_phone'];


        $other->update();
        return redirect()->route('receptionist.edit-patient', compact('user', 'other'))->with('success', 'Account updated successfully!');
    }

     public function show_password(User $user){
        return view('admin.change-password', compact('user'));
     }
     public function show_password_receptionist(User $user){
        return view('receptionist.change-password', compact('user'));
     }
     public function show_password_doctor(User $user){
        return view('doctor.change-password', compact('user'));
     }
     public function show_password_lab(User $user){
        return view('laboratory-technologist.change-password', compact('user'));
     }

     public function reset(User $user, User $other){
        $other->password=Hash::make("12345678");
        $other->update();
        return redirect()->route('admin.edit-employee', compact('user', 'other'))->with('success', 'Password reseted successfully!');


     }

     public function logout()
     {
         auth()->logout();

         request()->session()->invalidate();
         request()->session()->regenerateToken();
         return redirect()->route('login');
     }

     public function change_password(User $user){
        $validated = request()->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed||min:8',
        ]);
        $user2 = User::find($user->id);
        if (Hash::check($validated['old_password'], $user2->password)) {
            $user2->password = Hash::make($validated['password']);
        } else {
            return redirect()
                ->route('admin.show-password')
                ->withErrors([
                    'old_password' => 'Your password is incorrect',
                ]);
        }
        $user2->password = Hash::make($validated['password']);
        $user2->update();
        return redirect()->route('admin.show-password', compact('user'))->with('success', 'Password changed successfully!');
     }
     public function change_password_receptionist(User $user){
        $validated = request()->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed||min:8',
        ]);
        $user2 = User::find($user->id);
        if (Hash::check($validated['old_password'], $user2->password)) {
            $user2->password = Hash::make($validated['password']);
        } else {
            return redirect()
                ->route('receptionist.show-password')
                ->withErrors([
                    'old_password' => 'Your password is incorrect',
                ]);
        }
        $user2->password = Hash::make($validated['password']);
        $user2->update();
        return redirect()->route('receptionist.show-password', compact('user'))->with('success', 'Password changed successfully!');
     }
     public function change_password_doctor(User $user){
        $validated = request()->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed||min:8',
        ]);
        $user2 = User::find($user->id);
        if (Hash::check($validated['old_password'], $user2->password)) {
            $user2->password = Hash::make($validated['password']);
        } else {
            return redirect()
                ->route('doctor.show-password')
                ->withErrors([
                    'old_password' => 'Your password is incorrect',
                ]);
        }
        $user2->password = Hash::make($validated['password']);
        $user2->update();
        return redirect()->route('doctor.show-password', compact('user'))->with('success', 'Password changed successfully!');
     }
     public function change_password_lab(User $user){
        $validated = request()->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed||min:8',
        ]);
        $user2 = User::find($user->id);
        if (Hash::check($validated['old_password'], $user2->password)) {
            $user2->password = Hash::make($validated['password']);
        } else {
            return redirect()
                ->route('lab.show-password')
                ->withErrors([
                    'old_password' => 'Your password is incorrect',
                ]);
        }
        $user2->password = Hash::make($validated['password']);
        $user2->update();
        return redirect()->route('lab.show-password', compact('user'))->with('success', 'Password changed successfully!');
     }

     public function help(User $user){
        return view('admin.help', compact('user'));
     }
     public function help_receptionist(User $user){
        return view('receptionist.help', compact('user'));
     }
     public function help_doctor(User $user){
        return view('doctor.help', compact('user'));
     }
     public function help_lab(User $user){
        return view('laboratory-technologist.help', compact('user'));
     }

     public function show_patients(User $user){

        $patients = User::whereNull('role');

        if (request()->has('search')) {
            $patients->where('first_name', 'like', '%' . request()->get('search') . '%');

        }

        $patients = $patients->get();


        return view('receptionist.patient-list', compact('user', 'patients'));

     }
     public function show_patients_doctor(User $user){


        $currentDate = now()->format('Y-m-d');

        $patients = User::whereNull('role')
                ->where('position', true)
                ->whereExists(function ($query) use ($user, $currentDate) {
                    $query->select(DB::raw(1))
                          ->from('medical_histories')
                          ->whereColumn('users.id', 'medical_histories.patient_id')
                          ->where('medical_histories.doctor_id', $user->id)
                          ->whereDate('medical_histories.created_at', $currentDate);
                })
               ;




        if (request()->has('search')) {
            $patients->where('first_name', 'like', '%' . request()->get('search') . '%');

        }

        $patients = $patients->get();


        return view('doctor.patient-list', compact('user', 'patients'));

     }
     public function show_patients_doctor_histories(User $user, User $other){
        $otherUser = User::findOrFail($other->id);


        $mostRecentHistoryId = MedicalHistory::where('patient_id', $otherUser->id)
        ->orderBy('created_at', 'desc')
        ->first()->id ?? null;

// Fetch all medical histories related to $otherUser except the most recent
$medicalHistories = MedicalHistory::where('patient_id', $otherUser->id)
     ->where('id', '<>', $mostRecentHistoryId)
     ->orderBy('created_at', 'desc')
     ->get();


        return view('doctor.history-list', compact('user','otherUser', 'medicalHistories'));

     }
     public function show_triage_doctor(User $user){
        $today = Carbon::today();

        $patients = User::where('position', true)
        ->whereDoesntHave('medicalHistories', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        });

        if (request()->has('search')) {
            $patients->where('first_name', 'like', '%' . request()->get('search') . '%');

        }

        $patients = $patients->get();


        return view('doctor.triage-list', compact('user', 'patients'));

     }
     public function show_lab_patients(User $user){
        $labRequests = DB::table('lab_requests')
        ->whereNull('result')
        ->join('medical_histories', 'lab_requests.history_id', '=', 'medical_histories.id')
        ->join('users', 'medical_histories.patient_id', '=', 'users.id')
        ->select('users.first_name', 'users.father_name','users.date_of_birth', 'users.grand_father_name','lab_requests.test_type','lab_requests.id' )
        ;

        if (request()->has('search')) {
            $labRequests->where('first_name', 'like', '%' . request()->get('search') . '%');

        }

        $others = $labRequests->get();


        return view('laboratory-technologist.lab-list', compact('user', 'others'));

     }
     public function send(User $user, User $other)
     {
         $other->update(['position' => true]);

         return redirect()->route('receptionist.patient-list', compact('user'))->with('success', 'Patient sent successfully.');
     }
}
