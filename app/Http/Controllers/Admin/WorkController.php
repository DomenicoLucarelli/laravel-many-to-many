<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works= Work::all();

        return view('admin/works/index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin/works/create', compact('types', 'technologies'));
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

        $work = new Work();

        if($request->hasFile('image')){
            $path = Storage::put('work_images', $request->image);
            $formData['image'] = $path;
        }

        $work->fill($formData);

        $work->slug = Str::slug($work->title, '-');

        $work->save();

        if(array_key_exists('technologies',$formData)){
            $work->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        return view('admin/works/show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin/works/edit', compact('work','types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        $this->my_validation($request, $work->id);

        $formData= $request->all();

        if($request->hasFile('image')){
            
            if($work->image){
                Storage::delete($work->image);
            }

            $path = Storage::put('work_images', $request->image);
            $formData['image'] = $path;
        
        }

        $work->slug = Str::slug($formData['title'], '-');

        $work->update($formData);


        $work->save();

        if(array_key_exists('technologies',$formData)){
            $work->technologies()->sync($formData['technologies']);
        }else{
            $work->technologies()->detach();
        }

        return redirect()->route('admin.works.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        if($work->image){
            Storage::delete($work->image);
        }

        $work->delete();

        return redirect()->route('admin.works.index');
    }

    private function validation($request){
        

        $formData = $request->all();

        $validator = Validator::make($formData,

        [
            'title'=> 'required|min:2|max:50|unique:works,title',
            'description'=> 'required|min:2',
            'image'=> 'nullable|image|max:4096',
            'date'=> 'nullable',
            'type_id'=>'nullable|exists:types,id',
            'technologies'=>'exists:technologies,id',
            'git_url'=> 'required|min:2',
        ],
        
        [
            'title.required'=> 'Questo campo non può essere lascaito vuoto',
            'title.min'=> 'Questo campo deve avere minimo 2 caratter',
            'title.max'=> 'Questo campo può avere massimo 50 caratteri',
            'title.unique'=> 'Questo campo è già esistente',
            'description.required'=> 'Questo campo non può essere lascaito vuoto',
            'description.min'=> 'Questo campo deve avere minimo 2 caratter',          
            'image.max'=> 'Il file è troppo grande',
            'image.image'=> 'Il file deve essere una immagine',
            'type_id.exists'=>'Questo campo non è ammesso',
            'technologies.exists'=> 'Questo campo non è ammesso',
            'git_url.required'=> 'Questo campo non può essere lascaito vuoto',
            'git_url.min'=> 'Questo campo deve avere minimo 2 caratter',
            
            
        ])->validate();

        return $validator;
    }

    private function my_validation($request,$id){

        $formData = $request->all();
    
        $validator = Validator::make($formData, [
            'title' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('works', 'title')->ignore($id),
            ],
            'description'=> 'required|min:2',
            'image'=> 'nullable|image|max:4096',
            'date'=> 'nullable',
            'type_id'=>'nullable|exists:types,id',
            'git_url'=> 'required|min:2',
            'technologies'=>'exists:technologies,id'

        ], [
            'title.required'=> 'Questo campo non può essere lascaito vuoto',
            'title.min'=> 'Questo campo deve avere minimo 2 caratter',
            'title.max'=> 'Questo campo può avere massimo 50 caratteri',
            'title.unique'=> 'Questo campo è già esistente',
            'description.required'=> 'Questo campo non può essere lascaito vuoto',
            'description.min'=> 'Questo campo deve avere minimo 2 caratter',
            'image.max'=> 'Il file è troppo grande',
            'image.image'=> 'Il file deve essere una immagine',
            'type_id.exists'=>'Questo campo non è ammesso',
            'git_url.required'=> 'Questo campo non può essere lascaito vuoto',
            'git_url.min'=> 'Questo campo deve avere minimo 2 caratter',
            'technologies.exists'=> 'Questo campo non è ammesso',

        ])->validate();
    
        return $validator;
    }
}
