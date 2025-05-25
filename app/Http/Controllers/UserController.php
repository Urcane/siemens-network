<?php

namespace App\Http\Controllers;

use App\Models\SiteRegion;
use App\Models\User;
use App\Models\UserSiteRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role as ModelsRole;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()){
            
            $query = DB::table('users')
            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->join('roles','roles.id','=','model_has_roles.role_id')
            ->orderBy('id','DESC')
            ->select('users.*','roles.name as role')->where('status',1);
            
            $filterRole = $request->filters['filterRole'];
            if(!empty($filterRole) && $filterRole !== '*'){
                $query->where('model_has_roles.model_id', $filterRole);
            }else{
                $query;
            }
            
            $query = $query->get();
            
            return DataTables::of($query)
            ->addColumn('user', function($user){
                $firstLetter =  mb_substr($user->name, 0, 1);
                return "<div class=\"d-flex align-items-center\">
                <div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">
                <a href=\"#!\">
                <div class=\"symbol-label fs-3 bg-light-danger text-danger\">${firstLetter}</div>
                </a>
                </div>
                <div class=\"d-flex flex-column\">
                <span class=\"text-dark fw-bold d-block\">$user->name</span>
                <span class=\"text-muted\">$user->email</span>
                </div>
                </div>";
            })
            ->addColumn('role', function($role){
                return "<span class=\"badge badge-warning badge-lg\">$role->role</span>";
            })
            ->addColumn('regionItem', function($regionItem){
                $getregionItem = DB::table('user_site_regions')->join('site_regions','site_regions.id','user_site_regions.site_region_id')->where('user_site_regions.user_id',$regionItem->id)->get();
                $option = '';
                if(count($getregionItem) > 0){
                    foreach ($getregionItem as $gsi) {
                        $option .= "<li class=\"d-flex align-items-center pb-3\"><span class=\"bullet bg-primary me-3\"></span>{$gsi->region_name}</li>";
                    }
                    $return = "<div class=\"d-flex flex-column\">{$option}</div>";
                    return $return;
                }else{
                    return "-";
                }
            })
            ->addColumn('action', function($query){
                if (auth()->user()->hasRole('administrator') && auth()->user()->id != $query->id) {
                    $action = "
                    <a href=\"#kt_modal_edit_user\" data-bs-toggle=\"modal\" data-id=\"$query->id\" class=\"btn btn-sm btn-icon btn-light-primary btn-active-primary me-1 btn_edit_user\"><i class=\"fas fa-edit\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Edit\"></i></a>
                    <a href=\"#kt_modal_delete\" data-bs-toggle=\"modal\" data-id=\"$query->id\" class=\"btn btn-sm btn-icon btn-light-danger btn-active-danger me-1 btn_hapus_user\"><i class=\"fas fa-trash\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Hapus\"></i></a>
                    ";
                }elseif(auth()->user()->hasRole('administrator')){
                    $action = "
                    <a href=\"#kt_modal_edit_user\" data-bs-toggle=\"modal\" data-id=\"$query->id\" class=\"btn btn-sm btn-icon btn-light-primary btn-active-primary me-1 btn_edit_user\"><i class=\"fas fa-edit\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Edit\"></i></a>
                    ";
                }else{
                    $action = "";
                }
                return "
                ${action}
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['user','role','action','regionItem'])
            ->make(true);
        }
        
        $homepage = "List User";
        $getRole = ModelsRole::all();
        $getRegion = SiteRegion::all();
        return view('user.management.index', compact('homepage','getRole','getRegion'));
    }
    
    public function edit($id)
    {
        $query = DB::table('users')
        ->join('model_has_roles','model_has_roles.model_id','=','users.id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->orderBy('id','DESC')
        ->select('users.*','roles.name as role')->where('users.id',$id)->first();
        return response()->json($query);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $post = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->new_password),
        ]);
        $post->assignRole($request->role_id);

        for ($i=0; $i < count($request->site_region_id); $i++) { 
            $user_region = UserSiteRegion::create([
                'user_id' => $post->id,
                'site_region_id'=> $request->site_region_id[$i],
            ]);
        }
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $update = User::where('id',$request->user_id)->update([
            'name' => $request->name,
            'password' => bcrypt($request->new_password),
        ]);
        UserSiteRegion::where('user_id',$request->user_id)->delete();
        for ($i=0; $i < count($request->site_region_id); $i++) { 
            $user_region = UserSiteRegion::create([
                'user_id' => $request->user_id,
                'site_region_id'=> $request->site_region_id[$i],
            ]);
        }
        return response()->json($update);
    }

    public function destroy(Request $request)
    {
        $destroy = User::where('id',$request->id)->update([
            'status' => 0,
        ]);
        return response()->json($destroy);
    }
}


