<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ApplicantsController extends Controller
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
            $app = Applicants::with('work','rank','qualifications')->get();
            if (!$app){
                throw new NotFoundHttpException('Not data');
            }

//           $data = $this->_getValue();
//            die($data);
            DB::commit();
            return response()->json([
                'data'=>$app,
                'message'=>'success'
            ]);
        }catch (\Exception $exception){
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        $validator = Validator::make($request->all(), [
//            'ID_Recruiter' => 'required',
//            'RName' => 'required',
//            'Email' => 'required',
//            'PhoneNumber' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return response()->json($validator->errors()->toJson(), 400);
//        }
        DB::beginTransaction();
        try{
            $data = new Applicants();
            $data->ID_Applicants = $request['ID_Applicants'];
            $data->Email = $request['Email'];
            $data->FirstName = $request['FirstName'];
            $data->LastName = $request['LastName'];
            $data->Gender = $request['Gender'];
            $data->PhoneNumber = $request['PhoneNumber'];
            $data->DateOfBirth = $request['DateOfBirth'];
            $data->Locat = $request['Locat'];
            $data->Assess = $request['Assess'];
            $data->ID_Work = $request['ID_Work'];
            $data->ID_Qualifications = $request['ID_Qualifications'];
            $data->ID_Rank = $request['ID_Rank'];
            if ($request->file('CV')){
                $file = $request->file('CV');
                $filename= time().'.'.$request->file('CV')->extension();
                $path=public_path() . '/assets/fileCV';
                $file->move($path,$filename);
                $data->CV = 'http://127.0.0.1:8000/assets/fileCV/'.$filename;
            }
//image
            if($request->hasFile('Avatar')){
                $image = $request->file('Avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Avatar';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Avatar ='http://127.0.0.1:8000/assets/Avatar/'. $name;
            }
            if($request->hasFile('Cover')){
                $image = $request->file('Cover');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Cover';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Cover ='http://127.0.0.1:8000/assets/Cover/'.$name;
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
        //
        DB::beginTransaction();
        try{
//            die($id);
            $data = Applicants::where('ID_Applicants',$id)->with('work','rank','qualifications')->get();
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
        DB::beginTransaction();
        try{
            $data = Applicants::find($id);
            $data->Email = $request['Email'];
            $data->FirstName = $request['FirstName'];
            $data->LastName = $request['LastName'];
            $data->Gender = $request['Gender'];
            $data->PhoneNumber = $request['PhoneNumber'];
            $data->DateOfBirth = $request['DateOfBirth'];
            $data->Locat = $request['Locat'];
            $data->Assess = $request['Assess'];
            $data->ID_Work = $request['ID_Work'];
            $data->ID_Qualifications = $request['ID_Qualifications'];
            $data->ID_Rank = $request['ID_Rank'];
            if ($request->file('CV')){
                $file = $request->file('CV');
                $filename= time().'.'.$request->file('CV')->extension();
                $path=public_path() . '/assets/fileCV';
                $file->move($path,$filename);
                $data->CV = 'http://127.0.0.1:8000/assets/fileCV/'.$filename;
            }
//image
            if($request->hasFile('Avatar')){
                $image = $request->file('Avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Avatar';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Avatar ='http://127.0.0.1:8000/assets/Avatar/'. $name;
            }
            if($request->hasFile('Cover')){
                $image = $request->file('Cover');
                $name = time().'.'.$image->getClientOriginalExtension();
                // Thư mục upload
                $path =public_path() . '/assets/Cover';
                // Bắt đầu chuyển file vào thư mục
                $image->move($path,$name);
                $data->Cover ='http://127.0.0.1:8000/assets/Cover/'.$name;
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
