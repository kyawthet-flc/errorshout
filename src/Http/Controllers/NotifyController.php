<?php

namespace Kyawthet\ErrorShout\Http\Controllers;

use Kyawthet\ErrorShout\Models\Notify;

class NotifyController extends Controller
{
    public function index()
    {
        return view("errorshout::notifies.index",[
            'notifies' => Notify::where(function($q){
                if( count(request('status',[])) > 0) {
                    return $q->whereIn('status', request('status',[]));
                }
            })->paginate(15)
        ]);
    }

    public function fix($notify)
    {

        if( $notify = Notify::where('status', '!=', 'fixed')->whereId($notify)->first() ) {
            $notify->update(['status' => 'fixed']);
            return redirect()->to(url()->previous())->with(['success'=>'Successfully Fixed!']);
        }
        return redirect()->to(url()->previous())->with(['error'=>'Error to fix.']);
    }
}