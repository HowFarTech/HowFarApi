<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Traits\HttpResponseTrait;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class StatusController extends Controller
{
    //
    use HttpResponseTrait;

    public function index()
    {
        $user=User::with('status')->findOrFail(Auth::id());
        $allStatus = $user->status;
        return $this->success([
            'message' => "status",
            'data' => $allStatus,
        ]);

    }

    public function store(StoreStatusRequest $request)
    {
        DB::beginTransaction();
        try{
       $request->validated($request->all());
       $user = User::findOrFail(Auth::id());
       if($user){
        $status = Status::create([
            "senderUid" => $user->id,
            "serverTime" => $request->serverTime,
            "storageLink" => $request->storageLink,
            "statusType" => $request->statusType,
            "caption" => $request->caption,
            "timeSent" => $request->timeSent,
            "imageUri" => $request->imageUri,
            "videoUri" => $request->videoUri,
            "senderPhone" => $user->phone,
            "isAdmin" => $user->isAdmin,
            "captionBackgroundColor" => $request->captionBackgroundColor,
            "statusDeliveryType" => $request->statusDeliveryType,
        ]);
        DB::commit();

    return $this->success([
        'message' => "status created successfully",
        'data' => $status,
    ]);
       }





        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function show($id)
    {
        $status = Status::findOrFail($id);
        return $this->success([
            'message' => "view status"." ".$status->id,
            'data'=> $status
        ]);

    }

   public function destroy($id)
   {
    $status = Status::findOrFail($id);
    $status->delete();
    return $this->success([
        'message' => "status deleted successfully",
        'data'=> $status
    ]);
   }
}
