<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable){
        return $dataTable->render('users');
    }

    public function edit($id){
        $id = User::find($id);
        return view('edit', compact('id'));
    }

    public function getUser(){
        return view('new_user');
    }

    public function user(){
        return DataTables::of(User::query())
                    ->editColumn('created_at', function($request){
                        return $request->created_at->toDayDateTimeString();
                    })
                    ->editColumn('updated_at', function($request){
                        return $request->updated_at->toDayDateTimeString();
                    })
                    // ->addColumn('action', function($row){
                    //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    //     return $actionBtn;
                    // })
                    // ->rawColumns(['action'])
                    ->addColumn('action', 'usersdatatable.action')
                    ->editColumn('action', function ($item) {
                        $dropdown = '<div class="dropleft">
                                        <i class="fas fa-ellipsis-v" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </i>
                                        <div class="dropdown-menu mr-3" aria-labelledby="dropdownMenuLink">
                                            <div class="drop-wrap">
                                                <a class="dropdown-item" href="'.route('edit', $item->id).'"><i class="far fa-edit mr-2"></i> កែសម្រួល</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal{{$item->id}}"><i class="far fa-times-circle mr-2"></i> លុប</a>
                                            </div>
                                        </div>
                                    </div>';
                        return $dropdown;
                    })
                    ->make(true);
    }

    public function add(){
        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)

                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
