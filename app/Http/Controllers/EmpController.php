<?php

namespace App\Http\Controllers;

use App\Jobs\ExportData;
use App\Models\Employee;
use App\Models\EmployeeUpload;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\Role;
use App\Models\UserRole;
use App\Promotion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpController extends Controller
{
    public function addEmployee()
    {
        $roles = Role::get();

        return view('hrms.employee.add', compact('roles'));
    }

    public function processEmployee(Request $request)
    {
        $filename = null;

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $image_path = time() . $image->getClientOriginalName();
            $imageFullPath = $image->move('assets/img/avatars/', $image_path);
            $filename = $imageFullPath;
        }

        $user = new User;
        $user->name = $request->emp_name;
        $user->surname = $request->emp_surname;

        $user->email = $request->emp_email;
        $user->password = bcrypt($request->emp_password);
        $user->save();


        $emp = new Employee;
        $emp->photo = $filename;
        $emp->name = $request->emp_name;
        $emp->surname = $request->emp_surname;
        $emp->code = $request->emp_code;
        $emp->status = $request->emp_status;
        $emp->gender = $request->gender;
        $emp->date_of_birth = $request->date_of_birth;
        $emp->date_of_joining = $request->date_of_joining;
        $emp->number = $request->number;
        $emp->qualification = $request->qualification;
        $emp->emergency_number = $request->emergency_number;
        $emp->current_address = $request->current_address;
        $emp->permanent_address = $request->permanent_address;
        $emp->formalities = $request->formalities;
        $emp->offer_acceptance = $request->offer_acceptance;
        $emp->probation_period = $request->probation_period;
        $emp->date_of_confirmation = $request->date_of_confirmation;
        $emp->department = $request->department;
        $emp->salary = $request->salary;
        $emp->account_number = $request->account_number;
        $emp->bank_name = $request->bank_name;
        $emp->pf_status = $request->pf_status;
        $emp->date_of_resignation = $request->date_of_resignation;
        $emp->notice_period = $request->notice_period;
        $emp->last_working_day = $request->last_working_day;
        $emp->full_final = $request->full_final;
        $emp->user_id = $user->id;
        $emp->save();


        $userRole = new UserRole();
        $userRole->role_id = $request->role;
        $userRole->user_id = $user->id;
        $userRole->save();

        //$emp->userrole()->create(['role_id' => $request->role]);

        return json_encode(['title' => 'Success', 'message' => 'Employee added successfully', 'class' => 'modal-header-success']);

    }

    public function showEmployee()
    {
        $emps = User::with('employee', 'role.role')->paginate(15);
        $column = '';
        $string = '';

        $jsonEmpsCreate = Employee::select([
            'id',
            'code',
            'name',
            'surname',
            'status',
            'gender',
            'date_of_birth',
            'date_of_joining',
            'number',
            'qualification',
            'emergency_number',
            'current_address',
            'permanent_address',
            'formalities',
            'offer_acceptance',
            'probation_period',
            'date_of_confirmation',
            'department',
            'salary',
            'account_number',
            'bank_name',
            'pf_status',
            'date_of_resignation',
            'notice_period',
            'last_working_day',
            'full_final',
            'created_at',
        ])->get();
        $jsonEmps = json_encode($jsonEmpsCreate);

        return view('hrms.employee.show_emp', compact('emps', 'column', 'string', 'jsonEmps'));
    }

    public function showEdit($id)
    {
        $emps = User::where('id', $id)->with('employee', 'role.role')->first();

        $roles = Role::get();

        return view('hrms.employee.add', compact('emps', 'roles'));
    }

    public function doEdit(Request $request, $id)
    {
        $filename = 'profile_pic.png';

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $image_path = time() . $image->getClientOriginalName();
            $imageFullPath = $image->move('assets/img/avatars/', $image_path);
            $filename = $imageFullPath;
        }
        $photo = '/assets/img/avatars/' . $filename;
        $emp_name = $request->emp_name;
        $emp_surname = $request->emp_surname;
        $emp_code = $request->emp_code;
        $emp_status = $request->status;
        $emp_role = $request->role;
        $gender = $request->gender;
        $dob = $request->date_of_birth;

        $doj = $request->date_of_joining;
        $mob_number = $request->number;
        $qualification = $request->qualification;
        $emer_number = $request->emergency_number;
        $address = $request->current_address;
        $permanent_address = $request->permanent_address;
        $formalities = $request->formalities;
        $offer_acceptance = $request->offer_acceptance;
        $prob_period = $request->probation_period;
        $doc = $request->date_of_confirmation;
        $department = $request->department;
        $salary = $request->salary;
        $account_number = $request->account_number;
        $bank_name = $request->bank_name;
        $pf_status = $request->pf_status;
        $dor = $request->date_of_resignation;
        $notice_period = $request->notice_period;
        $last_working_day = $request->last_working_day;
        $full_final = $request->full_final;

        //$edit = Employee::findOrFail($id);
        $edit = Employee::where('user_id', $id)->first();


        if (!empty($photo)) {
            $edit->photo = $photo;
        }
        if (!empty($emp_name)) {
            $edit->name = $emp_name;
        }
        if (!empty($emp_surname)) {
            $edit->surname = $emp_surname;
        }
        if (!empty($emp_code)) {
            $edit->code = $emp_code;
        }
        if (isset($emp_status)) {
            $edit->status = $emp_status;
        }
        if (isset($emp_role)) {
            $userRole = UserRole::firstOrNew(['user_id' => $edit->user_id]);
            $userRole->role_id = $emp_role;
            $userRole->save();
        }
        if (isset($gender)) {
            $edit->gender = $gender;
        }
        if (!empty($dob)) {
            $edit->date_of_birth = $dob;
        }
        if (!empty($doj)) {
            $edit->date_of_joining = $doj;
        }
        if (!empty($mob_number)) {
            $edit->number = $mob_number;
        }
        if (!empty($qualification)) {
            $edit->qualification = $qualification;
        }
        if (!empty($emer_number)) {
            $edit->emergency_number = $emer_number;
        }
        if (!empty($address)) {
            $edit->current_address = $address;
        }
        if (!empty($permanent_address)) {
            $edit->permanent_address = $permanent_address;
        }

        if (isset($formalities)) {
            $edit->formalities = $formalities;
        }
        if (isset($offer_acceptance)) {
            $edit->offer_acceptance = $offer_acceptance;
        }
        if ($prob_period != null) {
            $edit->probation_period = $prob_period;
        }
        if (!empty($doc)) {
            $edit->date_of_confirmation = $doc;
        }
        if (!empty($department)) {
            $edit->department = $department;
        }
        if (!empty($salary)) {
            $edit->salary = $salary;
        }
        if (!empty($account_number)) {
            $edit->account_number = $account_number;
        }
        if (!empty($bank_name)) {
            $edit->bank_name = $bank_name;
        }
        if (!empty($pf_status)) {
            $edit->pf_status = $pf_status;
        }
        if (!empty($dor)) {
            $edit->date_of_resignation = $dor;
        }
        if (!empty($notice_period)) {
            $edit->notice_period = $notice_period;
        }
        if (!empty($last_working_day)) {
            $edit->last_working_day = $last_working_day;
        }
        if (isset($full_final)) {
            $edit->full_final = $full_final;
        }

        $edit->save();
        return json_encode(['title' => 'Success', 'message' => 'Employee details successfully updated', 'class' => 'modal-header-success']);
    }

    public function doDelete($id)
    {

        $emp = User::find($id);
        $emp->delete();

        \Session::flash('flash_message', 'Employee successfully Deleted!');

        return redirect()->back();
    }

    public function importFile()
    {
        return view('hrms.employee.upload');
    }

    public function uploadFile(Request $request)
    {
        $files = Input::file('upload_file');

        /* try {*/
        foreach ($files as $file) {
            Excel::load($file, function ($reader) {
                $rows = $reader->get(['emp_name', 'emp_surname', 'emp_code', 'emp_status', 'role',
                    'gender', 'dob', 'doj', 'mob_number', 'qualification', 'emer_number',
                    'address', 'permanent_address', 'formalities', 'offer_acceptance',
                    'prob_period', 'doc', 'department', 'salary', 'account_number',
                    'bank_name', 'pf_status', 'dor', 'notice_period', 'last_working_day', 'full_final']);

                foreach ($rows as $row) {
                    \Log::info($row->role);
                    $user = new User;
                    $user->name = $row->emp_name;
                    $user->surname = $row->emp_surname;
                    $user->email = str_replace(' ', '_', $row->emp_surname . $row->emp_name) . '@' . env('APP_NAME') . '.com';
                    $user->password = bcrypt('123456');
                    $user->save();
                    $attachment = new Employee();
                    $attachment->photo = '/img/Emp.jpg';
                    $attachment->name = $row->emp_name;
                    $attachment->code = $row->emp_code;
                    $attachment->status = convertStatus($row->emp_status);

                    if (empty($row->gender)) {
                        $attachment->gender = 'Not Exist';
                    } else {
                        $attachment->gender = $row->gender;
                    }
                    if (empty($row->dob)) {
                        $attachment->date_of_birth = '00-00-0000';
                    } else {
                        $attachment->date_of_birth = date('m-d-Y', strtotime($row->dob));
                    }
                    if (empty($row->doj)) {
                        $attachment->date_of_joining = '00-00-0000';
                    } else {
                        $attachment->date_of_joining = date('m-d-Y', strtotime($row->doj));
                    }
                    if (empty($row->mob_number)) {
                        $attachment->number = '1234567890';
                    } else {
                        $attachment->number = $row->mob_number;
                    }
                    if (empty($row->qualification)) {
                        $attachment->qualification = 'Not Exist';
                    } else {
                        $attachment->qualification = $row->qualification;
                    }
                    if (empty($row->emer_number)) {
                        $attachment->emergency_number = '1234567890';
                    } else {
                        $attachment->emergency_number = $row->emer_number;
                    }
                    if (empty($row->address)) {
                        $attachment->current_address = 'Not Exist';
                    } else {
                        $attachment->current_address = $row->address;
                    }
                    if (empty($row->permanent_address)) {
                        $attachment->permanent_address = 'Not Exist';
                    } else {
                        $attachment->permanent_address = $row->permanent_address;
                    }
                    if (empty($row->emp_formalities)) {
                        $attachment->formalities = '1';
                    } else {
                        $attachment->formalities = $row->emp_formalities;
                    }
                    if (empty($row->offer_acceptance)) {
                        $attachment->offer_acceptance = '1';
                    } else {
                        $attachment->offer_acceptance = $row->offer_acceptance;
                    }
                    if (empty($row->prob_period)) {
                        $attachment->probation_period = 'Not Exist';
                    } else {
                        $attachment->probation_period = $row->prob_period;
                    }
                    if (empty($row->doc)) {
                        $attachment->date_of_confirmation = '00-00-0000';
                    } else {
                        $attachment->date_of_confirmation = date('m-d-Y', strtotime($row->doc));
                    }
                    if (empty($row->department)) {
                        $attachment->department = 'Not Exist';
                    } else {
                        $attachment->department = $row->department;
                    }
                    if (empty($row->salary)) {
                        $attachment->salary = '00000';
                    } else {
                        $attachment->salary = $row->salary;
                    }
                    if (empty($row->account_number)) {
                        $attachment->account_number = 'Not Exist';
                    } else {
                        $attachment->account_number = $row->account_number;
                    }
                    if (empty($row->bank_name)) {
                        $attachment->bank_name = 'Not Exist';
                    } else {
                        $attachment->bank_name = $row->bank_name;
                    }
                    if (empty($row->pf_status)) {
                        $attachment->pf_status = '1';
                    } else {
                        $attachment->pf_status = $row->pf_status;
                    }
                    if (empty($row->dor)) {
                        $attachment->date_of_resignation = '00-00-0000';
                    } else {
                        $attachment->date_of_resignation = date('m-d-Y', strtotime($row->dor));
                    }
                    if (empty($row->notice_period)) {
                        $attachment->notice_period = 'Not exist';
                    } else {
                        $attachment->notice_period = $row->notice_period;
                    }
                    if (empty($row->last_working_day)) {
                        $attachment->last_working_day = '00-00-0000';
                    } else {
                        $attachment->last_working_day = date('m-d-Y', strtotime($row->last_working_day));
                    }
                    if (empty($row->full_final)) {
                        $attachment->full_final = 'Not exist';
                    } else {
                        $attachment->full_final = $row->full_final;
                    }
                    $attachment->user_id = $user->id;
                    $attachment->save();

                    $userRole = new UserRole();
                    $userRole->role_id = convertRole($row->role);
                    $userRole->user_id = $user->id;
                    $userRole->save();

                }

                return 1;
                //return redirect('upload_form');*/
            }
            );

        }
        /*catch (\Exception $e) {
           return $e->getMessage();*/

        \Session::flash('success', ' Employee details uploaded successfully.');

        return redirect()->back();
    }

    public function searchEmployee(Request $request)
    {
        $string = $request->string;
        $column = $request->column;
        if ($request->button == trans('messages.search')) {
            if ($string == '' && $column == '') {
                \Session::flash('success', ' Employee details uploaded successfully.');
                return redirect()->to('employee-manager');
            } elseif ($string != '' && $column == '') {
                \Session::flash('failed', ' Please select category.');
                return redirect()->to('employee-manager');
            } elseif ($column == 'email') {
                $emps = User::with('employee')->where($column, 'like', "%$string%")->paginate(20);
            } else {
                $emps = User::whereHas('employee', function ($q) use ($column, $string) {
                    $q->whereRaw($column . " like '%" . $string . "%'");
                }
                )->with('employee')->paginate(20);
            }

            $jsonEmps = json_encode($emps->items());
            return view('hrms.employee.show_emp', compact('emps', 'column', 'string', 'jsonEmps'));
        } else {
            if ($column == '') {
                $emps = User::with('employee')->get();
            } elseif ($column == 'email') {
                $emps = User::with('employee')->where($request->column, $request->string)->paginate(20);
            } else {
                $emps = User::whereHas('employee', function ($q) use ($column, $string) {
                    $q->whereRaw($column . " like '%" . $string . "%'");
                }
                )->with('employee')->get();
            }

            $fileName = 'Employee_Listing_' . rand(1, 1000) . '.xls';
            $filePath = storage_path('export/') . $fileName;
            $file = new \SplFileObject($filePath, "a");
            // Add header to csv file.
            $headers = array("id", "code", "name", "surname", "status", "gender", "date_of_birth",
                "date_of_joining", "number", "qualification", "emergency_number",
                "current_address", "permanent_address", "formalities", "offer_acceptance",
                "probation_period", "date_of_confirmation", "department", "salary", "account_number", "bank_name",
                "pf_status", "date_of_resignation", "notice_period", "last_working_day", "full_final",
                "created_at", "updated_at");
            $file->fputcsv($headers);
            foreach ($emps as $emp) {
                $file->fputcsv([
                        $emp->id,
                        $emp->employee->code,
                        $emp->employee->name,
                        $emp->employee->surname,
                        $emp->employee->status,
                        $emp->employee->gender,
                        $emp->employee->date_of_birth,
                        $emp->employee->date_of_joining,
                        $emp->employee->number,
                        $emp->employee->qualification,
                        $emp->employee->emergency_number,
                        $emp->employee->current_address,
                        $emp->employee->permanent_address,
                        $emp->employee->formalities,
                        $emp->employee->offer_acceptance,
                        $emp->employee->probation_period,
                        $emp->employee->date_of_confirmation,
                        $emp->employee->department,
                        $emp->employee->salary,
                        $emp->employee->account_number,
                        $emp->employee->bank_name,
                        $emp->employee->pf_status,
                        $emp->employee->date_of_resignation,
                        $emp->employee->notice_period,
                        $emp->employee->last_working_day,
                        $emp->employee->full_final,
                        $emp->employee->created_at,
                        $emp->employee->updated_at
                    ]
                );
            }
            return response()->download(storage_path('export/') . $fileName);
        }
    }


    public function showDetails()
    {
        $emps = User::with('employee')->paginate(15);

        return view('hrms.employee.show_bank_detail', compact('emps'));
    }

    public function updateAccountDetail(Request $request)
    {
        try {
            $model = Employee::where('id', $request->employee_id)->first();
            $model->bank_name = $request->bank_name;
            $model->account_number = $request->account_number;
            $model->save();

            return json_encode('success');
        } catch (\Exception $e) {
            \Log::info($e->getMessage() . ' on ' . $e->getLine() . ' in ' . $e->getFile());

            return json_encode('failed');
        }

    }

    public function doPromotion()
    {
        $emps = User::get();
        $roles = Role::get();

        return view('hrms.promotion.add_promotion', compact('emps', 'roles'));
    }

    public function getPromotionData(Request $request)
    {
        $result = Employee::with('userrole.role')->where('id', $request->employee_id)->first();
        if ($result) {
            $result = ['salary' => $result->salary, 'designation' => $result->userrole->role->name];
        }

        return json_encode(['status' => 'success', 'data' => $result]);
    }

    public function processPromotion(Request $request)
    {

        $newDesignation = Role::where('id', $request->new_designation)->first();
        $process = Employee::where('id', $request->emp_id)->first();
        $process->salary = $request->new_salary;
        $process->save();

        \DB::table('user_roles')->where('user_id', $process->user_id)->update(['role_id' => $request->new_designation]);

        $promotion = new Promotion();
        $promotion->emp_id = $request->emp_id;
        $promotion->old_designation = $request->old_designation;
        $promotion->new_designation = $newDesignation->name;
        $promotion->old_salary = $request->old_salary;
        $promotion->new_salary = $request->new_salary;
        $promotion->date_of_promotion = $request->date_of_promotion;
        $promotion->save();

        \Session::flash('flash_message', 'Employee successfully Promoted!');

        if (Auth::user()->role() == 'Admin') {
            return redirect()->back();
        } else {
            $events = $this->convertToArray(Event::where('date', '>', Carbon::now())->orderBy('date', 'desc')->take(3)->get());
            $meetings = $this->convertToArray(Meeting::where('date', '>', Carbon::now())->orderBy('date', 'desc')->take(3)->get());
            return view('hrms.dashboard', compact('events', 'meetings'));
        }
    }

    public function showPromotion()
    {
        $promotions = Promotion::with('employee')->paginate(10);

        return view('hrms.promotion.show_promotion', compact('promotions'));
    }

    public function convertToArray($values)
    {
        $result = [];
        foreach ($values as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }

}
