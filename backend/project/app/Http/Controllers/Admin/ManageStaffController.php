<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role as DashboardRole;

class ManageStaffController extends Controller
{
    public function index()
    {
        $roles = Role::all()->pluck('name');
    
        $search = request('search');
        $status = null;
        if(request('status') == 'active')  $status = 1;
        if(request('status') == 'banned')  $status = 2;
      
        $staffs =  Admin::where('id','!=',1)->paginate();

        return view('admin.staff.index',compact('staffs','roles'));
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:4',
            'role'     => 'required',
        ]);

        $staff = new Admin;
        $staff->name     = $request->name;
        $staff->email    = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->role     = $request->role;
        $staff->save();
        $this->syncDashboardRole($staff);
      
        return back()->with('success','Staff added successfully');
    }

    public function updateStaff(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => $request->password ? 'confirmed|min:4':'',
            'role'      => 'required',
            'status'      => 'required',
        ]);

        $staff = Admin::findOrFail($id);
        $staff->name     = $request->name;
        $staff->email    = $request->email;
        if($request->password) $staff->password = bcrypt($request->password);
        $staff->role     = $request->role;
        $staff->status     = $request->status;
        $staff->update();
        $this->syncDashboardRole($staff);

        return back()->with('success','Staff updated successfully');
    }

    public function destroy(Request $request)
    {
        $staff = Admin::findOrFail($request->id);
        $staff->delete();
        return back()->with('success','Staff deleted successfully');
    }

    private function syncDashboardRole(Admin $staff): void
    {
        $roleName = strcasecmp((string) $staff->role, 'staff') === 0
            ? 'Operations Manager'
            : 'Dashboard Administrator';

        $dashboardRole = DashboardRole::query()
            ->where('name', $roleName)
            ->where('guard_name', 'admin')
            ->first();

        if ($dashboardRole) {
            $staff->syncRoles([$dashboardRole]);
        }
    }
}
