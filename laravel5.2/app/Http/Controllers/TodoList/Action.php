<?php

namespace App\Http\Controllers\TodoList;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TodoList_model as TDM;

class Action extends Controller
{
    function save(Request $request)
    {
    	$method  = $request->method();
    	$message = array(
    						'status' 	=> false, 
    						'message' 	=> 'Proses gagal, silahkan diulang kembali.'
    					);

    	if($method == 'POST')
    	{
            if(TDM::where('list_konten', '=', $request->list_konten)->count() > 0)
            {
                $message = array(
                            'status'    => false, 
                            'message'   => 'Proses gagal, Data yang anda masukan telah ada.'
                        );
        
                return response($message);
                exit();
            }

    		$todo 				= new TDM;
    		$todo->list_konten 	= $request->list_konten;
    		$result 			= $todo->save();

    		if($result)
    		{
    			$message = array(
    							'status' 	=> true, 
    							'message' 	=> 'Proses berhasil, terima kasih.'
    						);
    		}
    	}
    	
    	return response($message);
    }

    function remove(Request $request)
    {
        $deleteid = $request->all();
        $message  = array(
                                'status'    => true, 
                                'message'   => 'Proses berhasil, terima kasih.'
                            );
        if($deleteid["deletetipe"] == 'all'){
            foreach ($deleteid["deleteitem"] as $value) {
                $item = TDM::find($value);
                if($item){
                    $item = TDM::destroy($value);
                    if(!$item)
                    {
                        $message = array(
                                        'status'    => false, 
                                        'message'   => 'Proses gagal, silahkan diulang kembali.'
                                    );
                        break;
                    }
                }
            }
        }
        else
        {
            $item = TDM::find($deleteid["deleteitem"]);
            $item = TDM::destroy($deleteid["deleteitem"]);
            if(!$item)
            {
                $message = array(
                                'status'    => false, 
                                'message'   => 'Proses gagal, silahkan diulang kembali.'
                            );
            }
        }

        return response($message);
    }
}
