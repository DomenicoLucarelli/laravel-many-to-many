<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin/technologies/index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/technologies/create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $formData = $request->all();

        $tech = new Technology();

        $tech->fill($formData);

        $tech->slug = Str::slug($tech->name, '-');

        $tech->save();

        return redirect()->route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin/technologies/edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $this->my_validation($request, $technology->id);
        $formData = $request->all();

        $technology->update($formData);

        $technology->slug = Str::slug($formData['name'], '-');

        $technology->save();

        return redirect()->route('admin.technologies.index'); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index'); 

    }

    private function validation($request){
        $formData = $request->all();

        $validator = Validator::make($formData,
        [
            'name' => 'required|max:50|unique:technologies,name',
            'color'=> 'required|max:7'
        ],
        [
            'name.required'=> 'Questo campo non può essere lascaito vuoto',
            'name.max'=> 'Questo campo può avere massimo 50 caratteri',
            'color.required'=> 'Questo campo non può essere lascaito vuoto',
            'color.max'=> 'Questo campo può avere massimo 7 caratteri',
        ])->validate();

        return $validator;
    }

    private function my_validation($request,$id){
        $formData = $request->all();

        $validator = Validator::make($formData,
        [
            'name' => [
                'required',
                'max:50',
                Rule::unique('technologies', 'name')->ignore($id),
                
            ],
            'color'=> 'required|max:7'
        ],
        [
            'name.required'=> 'Questo campo non può essere lascaito vuoto',
            'name.max'=> 'Questo campo può avere massimo 50 caratteri',
            'color.required'=> 'Questo campo non può essere lascaito vuoto',
            'color.max'=> 'Questo campo può avere massimo 7 caratteri',
        ])->validate();

        return $validator;
    }
}
