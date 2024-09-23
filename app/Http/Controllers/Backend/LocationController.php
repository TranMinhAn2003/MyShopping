<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;

class LocationController extends Controller
{
    protected  $districtRepository;
    protected  $provinceRepository;
    public function __construct(DistrictRepository $districtRepository, ProvinceRepository $provinceRepository)
    {
        $this->districtRepository=$districtRepository;
        $this->provinceRepository=$provinceRepository;
    }
    public function getLocation( Request $request)
    {

        $getdata=$request->input();
        $html='';
        if($getdata['target']=='districts'){
            $province = $this->provinceRepository->findById($getdata['data']['location_id'],['code','name'],['districts']);
            $html=$this->renderHtml($province->districts);
        }else if($getdata['target']=='wards'){
            $district=$this->districtRepository->findById($getdata['data']['location_id'],['code','name'],['wards']);
            $html=$this->renderHtml($district->wards,'[Chọn Phường/Xã]');
        }

          $repose=[
              'html'=>$html
              ];
          return response()->json($repose);
     }
     public function renderHtml($districts,$root='[Chọn Quận/Huyện]')
     {
         $html='<option value="0">'.$root.'</option>';
         foreach ($districts as $district ){
             $html .='<option value="'.$district->code.'"  >'.$district->name.' </option>';
         }
         return $html;
     }

}
