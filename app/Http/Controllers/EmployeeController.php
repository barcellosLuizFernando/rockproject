<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class EmployeeController extends Controller
{
    public function index()
    {

        $employee = Employee::all();

        session(['page' => 'employee']);

        return view('employee.show', ['employee' => $employee]);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->load('user');

        return view('employee.create', ['employee' => $employee]);
    }

    public function create()
    {

        $user = User::all();
        $employee = new Employee();


        return view('employee.create', ['users' => $user, 'employee' => $employee]);
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $idUser = 0;

        try {
            $user = new User();
            $user->name = $request->funName;
            $user->email = $request->funEmail;
            $user->password = md5(rand(0, 99999));
            $user->save();
        } catch (Throwable $e) {
        } finally {
            $user = User::where('email', $request->funEmail)->get();
            $idUser = $user[0]->id;
        }


        $employee->jobplace = $request->funjobplace;
        $employee->name = $request->funName;
        $employee->admissiondate = $request->funAdmissionDate;
        $employee->salary = str_replace(',', '.', $request->funsalary);
        $employee->jobtime = $request->funJobTime;
        $employee->role = $request->funRole;
        $employee->experiencetime = $request->funexperiencetime;
        $employee->admissiondate = $request->funadmissiondate;
        $employee->jobtime = $request->funjobtime;
        $employee->role = $request->funrole;
        $employee->birthdate = $request->funBirthDate;
        $employee->birthcity = $request->funBirthCity;
        $employee->birthstate = $request->funBirthState;
        $employee->maritalstatus = $request->funMaritalStatus;
        $employee->spousename = $request->funSpousse;
        $employee->fathersname = $request->funFathersName;
        $employee->mothersname = $request->funMothersName;
        $employee->kids = is_numeric($request->funKids) ? $request->funKids : 0;
        $employee->rgstate = $request->funRGState;

        $employee->idUser = $idUser;

        $employee->address = $request->funAddress;
        $employee->phone = $request->funPhone;
        $employee->district = $request->funDistrict;
        $employee->city = $request->funCity;
        $employee->state = $request->funState;
        $employee->adjunct = $request->funAdjunct;
        $employee->zipcode = $request->funZipCode;
        $employee->ctps = $request->funCTPS;
        $employee->ctpsdate = $request->funCTPSdate;
        $employee->cpf = $request->funCPF;
        $employee->rg = $request->funRG;
        $employee->rgissuer = $request->funRGIssuer;
        $employee->rgdate = $request->funRGDate;
        $employee->militarydoc = $request->funMilitaryDoc;
        $employee->militaryserie = $request->funMilitarySerie;
        $employee->militarycategory = $request->funMilitaryCategory;
        $employee->voterdoc = $request->funVoterDoc;
        $employee->voterzone = $request->funVoterZone;
        $employee->votersection = $request->funVoterSection;
        $employee->pis = $request->funPIS;
        $employee->driverslicense = $request->funDriversLicense;
        $employee->driverslicensecategory = $request->funDriversLicenseCategory;
        $employee->driverslicensedate = $request->funDriversLicenseDate;
        $employee->driverslicensedateexpired = $request->funDriversLicenseExpired;
        $employee->driverslicensedateissue = $request->funDriversLicenseExpired;
        $employee->graduation = $request->fungraduation;
        $employee->graduationstage = $request->fungraduationstage;
        $employee->graduationsituation = $request->fungraduationsituation;
        $employee->transportticket = $request->funtransportticket;
        $employee->transportticketcompany = $request->funtransportticketcompany;
        $employee->transportticketstages = $request->funtransportticketstages;
        $employee->experiencetime = $request->funexperiencetime;






        $employee->save();

        return redirect('/employee');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employee')
            ->with('msg', 'Cadastro excluído com sucesso!');
    }

    public function update(Request $request)
    {

        $employee = Employee::findOrFail($request->id);

        $employee->jobplace = $request->funjobplace;
        $employee->name = $request->funName;
        $employee->admissiondate = $request->funAdmissionDate;
        $employee->salary =  str_replace(',', '.', $request->funsalary);
        $employee->jobtime = $request->funJobTime;
        $employee->role = $request->funRole;
        $employee->experiencetime = $request->funexperiencetime;
        $employee->admissiondate = $request->funadmissiondate;
        $employee->jobtime = $request->funjobtime;
        $employee->role = $request->funrole;
        $employee->birthdate = $request->funBirthDate;
        $employee->birthcity = $request->funBirthCity;
        $employee->birthstate = $request->funBirthState;
        $employee->maritalstatus = $request->funMaritalStatus;
        $employee->spousename = $request->funSpousse;
        $employee->fathersname = $request->funFathersName;
        $employee->mothersname = $request->funMothersName;
        $employee->kids = is_numeric($request->funKids) ? $request->funKids : 0;
        $employee->rgstate = $request->funRGState;
        $employee->address = $request->funAddress;
        $employee->phone = $request->funPhone;
        $employee->district = $request->funDistrict;
        $employee->city = $request->funCity;
        $employee->state = $request->funState;
        $employee->adjunct = $request->funAdjunct;
        $employee->zipcode = $request->funZipCode;
        $employee->ctps = $request->funCTPS;
        $employee->ctpsdate = $request->funCTPSdate;
        $employee->cpf = $request->funCPF;
        $employee->rg = $request->funRG;
        $employee->rgissuer = $request->funRGIssuer;
        $employee->rgdate = $request->funRGDate;
        $employee->militarydoc = $request->funMilitaryDoc;
        $employee->militaryserie = $request->funMilitarySerie;
        $employee->militarycategory = $request->funMilitaryCategory;
        $employee->voterdoc = $request->funVoterDoc;
        $employee->voterzone = $request->funVoterZone;
        $employee->votersection = $request->funVoterSection;
        $employee->pis = $request->funPIS;
        $employee->driverslicense = $request->fundriverslicense;
        $employee->driverslicensecategory = $request->fundriverslicensecategory;
        $employee->driverslicensedate = $request->fundriverslicensedate;
        $employee->driverslicensedateexpired = $request->fundriverslicenseexpired;
        $employee->driverslicensedateissue = $request->funDriverslicenseexpired;
        $employee->graduation = $request->fungraduation;
        $employee->graduationstage = $request->fungraduationstage;
        $employee->graduationsituation = $request->fungraduationsituation;
        $employee->transportticket = $request->funtransportticket;
        $employee->transportticketcompany = $request->funtransportticketcompany;
        $employee->transportticketstages = $request->funtransportticketstages;
        $employee->experiencetime = $request->funexperiencetime;

        $employee->save();

        return redirect('/employee')
            ->with('msg', 'Cadastro atualizado com sucesso.');
    }
}
