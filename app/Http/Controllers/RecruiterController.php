<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecruiterController extends Controller
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
        try{
            $data = Recruiter::all();
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
        $validator = Validator::make($request->all(), [
            'ID_Recruiter' => 'required',
            'RName' => 'required',
            'Email' => 'required',
            'PhoneNumber' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        DB::beginTransaction();
        try{
            $data = new Recruiter();
            $data->ID_Recruiter = $request['ID_Recruiter'];
            $data->RName = $request['RName'];
            $data->Email = $request['Email'];
            $data->PhoneNumber = $request['PhoneNumber'];
            $data->Locat = $request['Locat'];
            $data->Assess = $request['Assess'];
//image
            if($request->hasFile('Avatar')){
                $image = $request->file('Avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Avatar';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Avatar ='https://apijob2.herokuapp.com/assets/Avatar/'. $name;  // đổi đường dẫn http://127.0.0.1:8000
            }
            if($request->hasFile('Cover')){
                $image = $request->file('Cover');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Cover';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Cover ='https://apijob2.herokuapp.com/assets/Cover/'.$name;
            }
            $data->save();
            DB::commit();
            return response()->json([
                'data'=> $data,
                'message'=>'create successfull'
            ]);

        }catch (\Exception $exception){
            throw $exception;
        }
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
        DB::beginTransaction();
        try{
//            die($id);
            $data = Recruiter::where('ID_Recruiter',$id)->get();
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
//        $validator = Validator::make($request->all(), [
//            'RName' => 'required',
//            'Email' => 'required',
//            'PhoneNumber' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return response()->json($validator->errors()->toJson(), 400);
//        }
        DB::beginTransaction();
        try{
//            $data = Recruiter::where('ID_Recruiter',$id)->get();
            $data = Recruiter::find($id);
            $data->RName = $request['RName'];
            $data->Email = $request['Email'];
            $data->PhoneNumber = $request['PhoneNumber'];
            $data->Locat = $request['Locat'];
            $data->Assess = $request['Assess'];
//image
            if($request->hasFile('Avatar')){
                $image = $request->file('Avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Avatar';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Avatar ='https://apijob2.herokuapp.com/assets/Avatar/'. $name;
            }
            if($request->hasFile('Cover')){
                $image = $request->file('Cover');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Cover';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Cover ='https://apijob2.herokuapp.com/assets/Cover/'.$name;
            }
//            die($data);

            $data->save();
            DB::commit();
            return response()->json([
                'data'=> $data,
                'message'=>'create successfull'
            ]);

        }catch (\Exception $exception){
            throw $exception;
        }

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
}
