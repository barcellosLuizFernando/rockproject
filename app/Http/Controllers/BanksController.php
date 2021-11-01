<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class BanksController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('name')->get();

        return view('finance.banks.show', ['banks' => $banks]);
    }

    public function create()
    {
        $bank = new stdClass();
        $bank->name = null;
        $bank->alias = null;
        $bank->codcomp = null;
        $bank->site = null;

        return view('finance.banks.create', ['bank' => $bank]);
    }

    public function store(Request $request)
    {

        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/banks', $file, $name);
        }

        $bank = new Bank();
        $bank->name = $request->bankName;
        $bank->alias = $request->bankAlias;
        $bank->codcomp = substr($request->codcomp, 0, 3);
        $bank->site = $request->site;
        $bank->filename = $name;
        $bank->save();

        return redirect('/finance/banks');
    }

    public function show($id)
    {
        $bank = Bank::findOrFail($id);

        return view('finance.banks.create', ['bank' => $bank]);
    }

    public function update(Request $request)
    {

        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/banks', $file, $name);
        }

        $bank = Bank::findOrFail($request->id);
        $bank->name = $request->bankName;
        $bank->alias = $request->bankAlias;
        $bank->codcomp = substr($request->codcomp, 0, 3);
        $bank->site = $request->site;
        $bank->filename = $name;
        $bank->save();

        return redirect('/finance/banks');
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id)->delete();

        return redirect('/finance/banks');
    }
}
