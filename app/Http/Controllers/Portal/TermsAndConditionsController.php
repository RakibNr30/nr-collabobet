<?php

namespace App\Http\Controllers\Portal;

use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        $termsAndConditions = TermsAndCondition::query()->firstOrCreate([]);

        return view('portal.terms_and_conditions.index', compact('termsAndConditions'));
    }

    public function update(Request $request, $id)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        $rules = [
            'details' => 'nullable|max:4294967295',
        ];

        $request->validate($rules);

        try {

            DB::beginTransaction();

            $termsAndCondition = TermsAndCondition::query()->firstOrCreate([]);

            $termsAndCondition->update($request->all());

            DB::commit();

            session()->flash('success', 'Terms & conditions updated successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
