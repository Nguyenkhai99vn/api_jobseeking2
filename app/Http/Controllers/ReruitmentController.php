<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        DB::beginTransaction();
        try {
            $data = Recruitment::with('recruiter', 'job', 'style')->get();
            if (!$data) {
                throw new NotFoundHttpException('not data');
            }
            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'success'
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        try {
            $data = new Recruitment();
            $data->ID_Recruitment = $request['ID_Recruitment'];
            $data->ID_Recruiter = $request['ID_Recruiter'];
            $data->ID_Job = $request['ID_Job'];
            $data->ID_Style = $request['ID_Style'];
            $data->Title = $request['Title'];
            $data->Descrip = $request['Descrip'];
            $data->Interest = $request['Interest'];
            $data->Request = $request['Request'];
            $data->SalaryMin = $request['SalaryMin'];
            $data->SalaryMax = $request['SalaryMax'];
            $data->Place = $request['Place'];

            $data->save();
            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'create successfull'
            ]);

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //
        DB::beginTransaction();
        try{
//            die($id);
            $data = Recruitment::where('ID_Recruitment',$id)->with('recruiter', 'job', 'style')->get();
            if (!$data){
                throw new NotFoundHttpException('not data');
            }
            DB::commit();
            return response()->json([
                'data'=>$data,
                'message' => 'success'
            ]);
        }catch (\Exception $exception){
            throw  $exception;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $data = Recruitment::find($id);
            $data->ID_Recruiter = $request['ID_Recruiter'];
            $data->ID_Job = $request['ID_Job'];
            $data->ID_Style = $request['ID_Style'];
            $data->Title = $request['Title'];
            $data->Descrip = $request['Descrip'];
            $data->Interest = $request['Interest'];
            $data->Request = $request['Request'];
            $data->SalaryMin = $request['SalaryMin'];
            $data->SalaryMax = $request['SalaryMax'];
            $data->Place = $request['Place'];

            $data->save();
            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'create successfull'
            ]);

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {

        DB::beginTransaction();
        try {
            $salaryMin = $request['SalaryMin'];
            $salaryMax = $request['SalaryMax'];
            $job = $request['job'];
            $style = $request['style'];
            $place = $request['place'];
            $query = Recruitment::query();

            if (isset($salaryMin)) {
                $query->where('SalaryMin', '>=',"$salaryMin");
            }
            if (isset($salaryMax)) {
                $query->where('SalaryMax','<=',"$salaryMax");
            }
            if (isset($job)) {
                $query->whereHas('job', function ($q) use ($job) {
                    return $q->where('JName', 'like', '%' . $job . '%');
                });
            }
            if (isset($style)) {
                $query->whereHas('style',function ($q) use($style){
                    return $q->where('SName','like','%'.$style.'%');
                });
            }
            if (isset($place)) {
                $query->where('Place','like','%'.$place.'%');
            }
            $data = $query->get();
            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'success'
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
