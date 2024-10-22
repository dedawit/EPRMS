<?php

namespace App\Http\Controllers;
use App\models\User;
use App\models\MedicalHistory;
use App\models\LabRequest;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    //
    public function show(User $user, User $other)
    {
        $doctors = User::where('role', 'doctor')->get();

        return view('doctor.triage-send', compact('user', 'other', 'doctors'));
    }

    public function show_lab(User $user, User $other, MedicalHistory $history)
    {
        return view('doctor.lab-request', compact('user', 'other', 'history'));
    }
    public function store(User $user, User $other)
    {
        $validated = request()->validate([
            'bloodPressure' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'heartRate' => 'required|integer|min:0',
            'doctor' => 'required',
        ]);

        $data = MedicalHistory::create([
            'patient_id' => $other->id,
            'doctor_id' => request()->doctor,
            'weight' => request()->weight,
            'heart_rate' => request()->heartRate,
            'blood_pressure' => request()->bloodPressure,
            'temperature' => request()->temperature,
        ]);

        return redirect()->route('doctor.triage-list', compact('user'))->with('success', 'Patient sent to doctor successfully!');
    }
    public function store_lab(User $user, User $other, MedicalHistory $history, Request $request)
    {
        $validated = $request->validate(
            [
                'lab' => 'required|array|min:1',
                'lab.*' => 'string',
            ],
            [
                'lab.required' => 'You must select at least one lab test.',
                'lab.min' => 'You must select at least one lab test.',
            ],
        );

        foreach ($request->lab as $labTest) {
            LabRequest::create(['test_type' => $labTest, 'history_id' => $history->id]);
        }

        return redirect()->route('doctor.show-one-patient', compact('history', 'user', 'other'))->with('success', 'Lab request added successfully.');
    }

    public function show_one_patient(User $user, User $other)
    {
        $today = now()->startOfDay();
        $history = MedicalHistory::where('patient_id', $other->id)
            ->whereDate('created_at', $today)
            ->first();

        $labRequests = collect();

        $labRequests = $history->labRequests()->get();

        return view('doctor.add-observation', compact('user', 'other', 'labRequests', 'history'));
    }
    public function show_patients_history(User $user, User $other, MedicalHistory $history)
    {


        $labRequests = collect();

        $labRequests = $history->labRequests()->get();

        return view('doctor.history-view', compact('user', 'other', 'labRequests', 'history'));
    }
    public function show_lab_request(User $user, LabRequest $other)
    {

        $labRequest = DB::table('lab_requests')
        ->select(
            'lab_requests.id',
            'lab_requests.test_type',
            'lab_requests.result',

            'users.first_name',
            'users.father_name',
            'users.grand_father_name'
        )
        ->join('medical_histories', 'lab_requests.history_id', '=', 'medical_histories.id')
        ->join('users', 'medical_histories.patient_id', '=', 'users.id')
        ->where('lab_requests.id', $other->id)
        ->first();



$patient = $labRequest->first_name." ".$labRequest->father_name." ".$labRequest->grand_father_name;



        return view('laboratory-technologist.lab-result', compact('user', 'labRequest', 'patient'));
    }

    public function store_observation(User $user, User $other, MedicalHistory $history)
    {
        request()->validate([
            'observation' => 'required',
        ]);
        $data = MedicalHistory::where('id', $history->id)->update([
            'details' => request()->observation,
        ]);
        return redirect()->route('doctor.show-one-patient', compact('history', 'user', 'other'))->with('success', 'Observation added successfully.');
    }

    public function store_medicine(User $user, User $other, MedicalHistory $history)
    {
        request()->validate([
            'medicine' => 'required',
        ]);
        $data = MedicalHistory::where('id', $history->id)->update([
            'medicine' => request()->medicine,
        ]);
        return redirect()->route('doctor.show-one-patient', compact('history', 'user', 'other'))->with('success', 'Medications added successfully.');
    }
    public function store_refer(User $user, User $other, MedicalHistory $history)
    {
        request()->validate([
            'referral' => 'required',
        ]);
        $data = MedicalHistory::where('id', $history->id)->update([
            'referral' => request()->referral,
        ]);
        return redirect()->route('doctor.show-one-patient', compact('history', 'user', 'other'))->with('success', 'Referrals added successfully.');
    }
    public function finish(User $user, User $other, MedicalHistory $history)
    {

        $data = User::where('id', $other->id)->update([
            'position' => false,
        ]);
        return redirect()->route('doctor.patient-list', compact( 'user'))->with('success', 'Treatment completed successfully.');
    }

    public function store_lab_request(User $user, LabRequest $labRequest){

        $request = request();
        $validated = $request->validate(
            [
                'result' => 'required',

            ]);
        $filePath=null;
        if (request()->hasFile('file-result')) {



            $file = request()->file('file-result');
            $uniqueFolderName = date('YmdHis') . '_' . uniqid();
            $filePath = $file->storeAs('my_lab_result/' . $uniqueFolderName, $file->getClientOriginalName(), 'public');
        }

        LabRequest::where('id', $labRequest->id)->update([
            'result' => request()->result, 'file'=>$filePath, 'laboratory_id'=>$user->id
        ]);



        return redirect()->route('lab.patient-list', compact('user'))->with('success','Lab result submitted successfully.');
     }
}
