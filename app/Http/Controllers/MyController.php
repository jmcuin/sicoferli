<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Estado;
use Yajra\Datatables\Datatables;

class MyController extends Controller
{
    //
	public function getIndex()
	{
	    return view('datatables.index');
	}

	 public function index() {
        if (request()->ajax()) {
            return Datatables::of(Estado::query())->make(true);
        }

        return view('datatables.index');
    }

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData()
	{
	    return Datatables::of(Estado::query())->make(true);
	}
}
