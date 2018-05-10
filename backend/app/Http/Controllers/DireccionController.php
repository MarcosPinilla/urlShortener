<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Direccion;
use JWTAuth;
use App\Http\Controllers\AuthenticateController;
use DB;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthenticateController $auth)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        return Direccion::where('id_usuario', $user->id)->get();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acortarUrl(Request $request, AuthenticateController $auth) {
        $ruta = "";
        $local = "localhost:8000/";
        $equal = false;
        do{
            for ($i = 0; $i < 5; $i++) {
                $ruta .= chr(rand(97, 122));
            }

            $direccion = Direccion::select('short')->where('short', $ruta)->first();

            

            if($ruta == $direccion){
                $equal = true;
            } else {
                $equal = false;
            }



        }while($equal);

        $user = \JWTAuth::parseToken()->authenticate();
        
        if (filter_var($request->url, FILTER_VALIDATE_URL)) {
            
            DB::table('direcciones')->insert([
                ['short' => $ruta, 'fullUrl' => $request->url, 'id_usuario' => $user->id ]
            ]);
            
            return $local.$ruta;

        } else {
            
            return ['error' => true];

        }

        
    }

    public function redireccionUrl($short){
        
        $direccion = Direccion::where('short', $short)->first();

        return redirect()->away($direccion->fullUrl);
        //"Https://www.".$direccion->fullUrl

    }
}
