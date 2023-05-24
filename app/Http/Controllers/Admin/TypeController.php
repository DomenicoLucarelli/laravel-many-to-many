<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('admin/works_types/index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/works_types/create');
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

        $type = new Type();

        $type->fill($formData);

        $type->slug = Str::slug($type->name, '-');

        $type->save();

        return redirect()->route('admin.types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin/works_types/edit', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $this->validation($request);
        
        $formData = $request->all();
        
        $type->slug = Str::slug($formData['name'], '-');

        $type->update($formData);

        $type->save();
        

        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }

    private function validation($request){

        $formData = $request->all();

        $validator = Validator::make($formData,[
            
            'name'=>'required|max:50|unique:types,name',
        ],[
            'name.required' =>'Questo campo non può essere lascaito vuoto',
            'name.max' =>'Questo campo non può avere più di 50 caratteri',
            'name.unique' =>'Questo nome esiste già'
        ])->validate();

        return $validator;
    }

//     private function my_validation($request,$id){

//     $formData = $request->all();

//     $validator = Validator::make($formData, [
//         'name' => [
//             'required',
//             'max:50',
//             Rule::unique('types', 'name')->ignore($id),
//         ],
//     ], [
//         'name.required' => 'Questo campo non può essere lasciato vuoto',
//         'name.max' => 'Questo campo non può avere più di 50 caratteri',
//         'name.unique' => 'Questo nome esiste già',
//     ])->validate();

//     return $validator;
// }
}
