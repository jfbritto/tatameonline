<?php

namespace App\Http\Controllers\Api\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AcademyService;
use App\Models\Academy;

class AcademyController extends Controller
{
    private $academyService;

    public function __construct(AcademyService $academyService)
    {
        $this->academyService = $academyService;
    }

    public function index()
    {
        $response = $this->academyService->index();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $dataValid = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'responsible' => 'required',
            'phoneResponsible' => 'required',
        ]);

        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

        $name_academy_site = kebab_case( str_replace($comAcentos, $semAcentos, $request->name) );

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'responsible' => $request->responsible,
            'phoneResponsible' => $request->phoneResponsible,
            'siteName' => $name_academy_site,
            'zipCode' => $request->zipCode,
            'city' => $request->city,
            'neighborhood' => $request->neighborhood,
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        $response = $this->academyService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $response = $this->academyService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}
