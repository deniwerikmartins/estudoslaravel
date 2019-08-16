<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContatoRequest;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //return response()->json(Contato::all());
        
        //$contatos = response()->json(Contato::all());
        
        $contatos = Contato::all();

        /*foreach ($contatos as $key => $contato) {
            echo($contato->nome);
        }
        die();

        echo("<pre>");
        print_r($contatos);
        echo("</pre>");
        die();*/

        return view('images', compact('contatos'));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContatoRequest $request)
    {
        //
        //Contato::create($request->all());
        
        /*$file = $request->file('file');

        echo $file->getClientOriginalName();

        echo $file->getClientSize();*/

        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();

            $file->move('images', $name);

            $input['path'] = $name;
        }

        Contato::create($input);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
        //
        $contato->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        //
        $contato->delete();
    }

    public function teste($id)
    {

        $msg = $_POST['msg'];
        echo($id . " teste " . $msg);
    }
}
