<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function usersList()
    {
        if (!Auth::user()) abort(404);

        $userTypes = User::all();
        return view('admin.users.all_user_list', compact('userTypes'));
    }

    public function dataTableUsersListTable(Request $request)
    {
        if (!Auth::user() ) abort(404);

        #main query
        $query  = User::with('userType');

        #search_key filter
        if (isset($request->filterSearchKey) && !empty($request->filterSearchKey)) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->filterSearchKey . '%')
                    ->orWhere('email', 'like', '%' . $request->filterSearchKey . '%')
                    ->orWhere('phone', 'like', '%' . $request->filterSearchKey . '%');
            });
        }

        #user type filter
        if (isset($request->filterUserType) && !empty($request->filterUserType) && $request->filterUserType != 'all') {
            $query->where('user_type', $request->filterUserType);
        }

        #status filter
        if (isset($request->filterStatus) && in_array($request->filterStatus, ['0', '1'])) {
            $query->where('is_active', $request->filterStatus);
        }

        $query = $query->orderBy('created_at', 'desc');

        if (!empty($query)) {
            return DataTables::of($query)->make(true);
        }
        return Datatables::of($query)->make(true);
    }


    public function viewUser($uuid)
    {
        if (!Auth::user() ) abort(404);

        $userDetails = User::where('uuid',$uuid)->with('media')->first();
        return view('admin.users.view_user',compact('userDetails'));

    }

    public function editUser($uuid)
    {
        if (!Auth::user() ) abort(404);

        $userDetails = User::where('uuid',$uuid)->first();
        return view('admin.users.edit_user',compact('userDetails'));
    }

    public function updateUser(Request $request,$uuid)
    {
        if (!Auth::user()) abort(404);
        DB::beginTransaction();
        try {
            $result                 = User::where('uuid',$uuid)->first();
            $result->full_name      = $request->full_name;
            $result->name           = str_replace(" ", "", $request->full_name);
            $result->phone          = $request->phone;
            $result->is_active      = $request->has('is_active');
            $result->birthdate      = $request->birthdate;
            $result->save();

            DB::commit();
            Session::flash('alert-success', __('message.User_updated_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('####### ManageUserController -> updateUser() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }
    public function updateUserImage(Request $request,$uuid)
    {
        if (!Auth::user()) abort(404);

        $validData = validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);
        if ($validData->fails()) {
            Session::flash('alert-error', $validData->getMessageBag()->first());
            return redirect()->back();
        }

        try {
            #save image
            if ($request->hasFile('image')) {
                // $path  = config('image.profile_image_path_store');
                // $media = CommenController::saveImage($request->image, $path);
                // User::where('uuid', $uuid)->update(['media_id' => $media]);
            }

            Session::flash('alert-success', __('message.user_image_updated_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('####### HomeController -> updateProfileImage() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back();
        }
    }

    public function destroyUser($uuid)

    {
        if (!Auth::user() ) abort(404);
        DB::beginTransaction();
        try {
            User::where('uuid',$uuid)->delete();
            DB::commit();
            return response()->json(['status' => 'User deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('####### ManageUserController -> updateUser() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back();

        }

    }
}
