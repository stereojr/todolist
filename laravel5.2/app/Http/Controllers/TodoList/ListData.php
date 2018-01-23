<?php

namespace App\Http\Controllers\TodoList;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TodoList_model as TDM;

class ListData extends Controller
{
    //
    function json_data(Request $request)
    {
    	$search = $request->all();

    	if(!empty($search))
    	{
    		$todos  = TDM::where('list_konten','LIKE','%'.$search['search'].'%')->orderBy('id', 'desc')->get();
    	}
    	else
    	{
    		$todos  = TDM::orderBy('id', 'desc')->get();
    	}

    	$result = array('data'=>$this->generate_data($todos));
    	return response($result);
    }

    function generate_data($data = array())
    {
    	$html = '<ul class="collection">';
    	if($data->count() > 0)
    	{
			foreach($data as $row) 
			{ 
				$html .= '<li class="collection-item">';
				$html .= '<div class="col s2">';
				$html .= '<p class="todo-check">';
				$html .= '<input type="checkbox" 
								 id="list-'.$row->id.'" class="todo-item" konten="'.$row->id.'" onclick="selected(this.id)"/>';
				$html .= '<label for="list-'.$row->id.'">';
				$html .= $row->list_konten;
				$html .= '</label>';
				$html .= '</p>';
				$html .= '<div>';
				$html .= '<a href="javascript:void(0)" id="delete-'.$row->id.'" value="'.$row->id.'"
							 class="right" action='.url('/proses/todo/remove').' onclick="deleteSelected(this.id)">';
				$html .= '<i class="material-icons">delete</i></a>';
				$html .= '</a>';
				$html .= '</div>';
				$html .= '<br clear="all"/>';
				$html .= '</div>';
				$html .= '</li>';
			}
		}
		else
		{
			$html .= '<li class="collection-item"><center>Tidak ada Data</center></li>';
		}
		$html .= '</ul>';

		return $html;
    }
}
