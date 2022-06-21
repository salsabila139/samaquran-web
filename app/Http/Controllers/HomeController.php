<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $title = 'Data Kutipan';
        $i = 1;
        $quotes = Quote::all();
        return view('dasmin.layout.index', compact('quotes', 'title', 'i'));
    }

    public function create()
    {
        return view('dasmin.layout.create');
    }

    public function store(Request $request)
    {
        Quote::create([

            'kutipan' => $request->kutipan,
            'sumber' => $request->sumber
        ]);

        return redirect(route('home'));
    }

    public function edit($id)
    {
        $title = 'Edit Kutipan';
        $quote = Quote::findOrFail($id);
        return view('dasmin.layout.edit', compact('title', 'quote'));
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
            $quote->update([
                'kutipan'       => $request->kutipan,
                'sumber'        => $request->sumber,
                
            ]);
            return redirect()->route('home');
    }

    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();

        return redirect()->back();
    }
}
