<?php

namespace App\Http\Controllers\Portal;

use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        if (AuthUser::isUser()) {
            $faqs = Faq::query()->get();
        } else {
            $faqs = Faq::query()->paginate();
        }

        return view('portal.faq.index', compact('faqs'));
    }

    public function create()
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        return view('portal.faq.create');
    }

    public function store(Request $request)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        $rules = [
            'question' => 'required|max:255',
            'answer' => 'required|max:1000',
        ];

        $request->validate($rules);

        try {

            DB::beginTransaction();

            Faq::query()->create($request->all());

            DB::commit();

            session()->flash('success', 'Faq added successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');

            return redirect()->back()->withInput($request->all());
        }

        return redirect()->route('portal.faq.index');
    }

    public function show(Faq $faq)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        return view('portal.faq.show', compact('faq'));
    }


    public function edit(Faq $faq)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        return view('portal.faq.edit', compact('faq'));
    }


    public function update(Request $request, Faq $faq)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        $rules = [
            'question' => 'required|max:255',
            'answer' => 'required|max:1000',
        ];

        $request->validate($rules);

        try {

            DB::beginTransaction();

            $faq->update($request->all());

            DB::commit();

            session()->flash('success', 'Faq updated successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }

    public function destroy(Faq $faq)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        try {

            DB::beginTransaction();

            $faq->delete();

            DB::commit();

            session()->flash('success', 'Faq deleted successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
