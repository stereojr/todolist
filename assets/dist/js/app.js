var array 	= [];
var i 		= 1;

$(document).ready(function(){
	$(document).ajaxStart(function(){
	    blockui();
	});

	$(document).ajaxStop(function(){
	    $.unblockUI();
	});

	showList('#todo-list');
	clear();
	addList();
	selectAll();
});

/*
 | SELECT
 | ALL CHECKBOX
*/
function selectAll()
{
	$("#selectAll").prop('checked',false);
	$("#selectAll").click(function () {
		$('.todo-item').prop('checked', this.checked);

		var hitung = 0;
		$('.todo-item').each(function(i,index) {
			konten = $(this).attr('konten');
			if(isValidCode(konten) === false)
			{
				array.push(konten);
			}
		});

		if(this.checked === false)
		{
			array = [];
		}

		$("#todo-i-selected").html(array.length);
    });
}

/*
 | SELECT
 | SINGLE CHECKBOX
*/
function selected(id)
{
	var selected = $("#"+id);
	var konten 	 = selected.attr('konten').trim();

	if(selected.is(':checked') === true)
	{
		if(isValidCode(konten) === false)
		{
			array.push(konten);
		}
		i++;
	}
	else
	{
		var index = array.indexOf(konten);
		array.splice(index, 1);
		i--;
	}
	
	$("#todo-i-selected").html(array.length);

	if(array.length <= 0)
	{
		$("#selectAll").prop('checked',false);
	}

	if($('.todo-item').length == array.length)
	{
		$("#selectAll").prop('checked',true);
	}
}

/*
 | SHOW
 | LIST DATA
*/
function showList(id,param)
{
	var list = $(id);
	var url  = list.attr('data-source');

	$.ajax({
		type	:'GET',
		url		:url,
		data    :{
			'search' : param
		},
		success:function(response){
			$('#todo-list').html(response.data);
		}
	});
}

/*
 | SEARCH
 | LIST DATA
*/
function SearchData()
{
	var search_todo = $("#search").val();
	showList('#todo-list',search_todo);
}

/*
 | DELETE
 | ALL DATA
*/
function deleteAll(id)
{
	var todo 	  = $('#todo_add');
	var csrf      = todo.find('input[name="_token"]');
	var url       = $("#"+id).attr('action');
	$.ajax({
		type	:'DELETE',
		url		:url,
		data	:{
			_method  		: 'delete',
			'_token'  		: csrf.val(),
			'deleteitem' 	: array,
			'deletetipe'	: 'all'
		},
		success:function(response){
			if(response.status == false)
            {
                showAlert('Oops',response.message,'error');
            }
            else
            {
                console.log('sukses');
				showList('#todo-list');
				clear();

	            array = [];
				$("#todo-i-selected").html(array.length);
				$("#selectAll").prop('checked',false);
            }
		}
	});
}

/*
 | DELETE
 | SELECTED DATA
*/
function deleteSelected(id)
{
	var todo 	  = $('#todo_add');
	var csrf      = todo.find('input[name="_token"]');
	var selector  = $('#'+id);
	var url       = selector.attr('action');
	var value     = selector.attr('value');
	$.ajax({
		type	:'DELETE',
		url		:url,
		data	:{
			_method  		: 'delete',
			'_token'  		: csrf.val(),
			'deleteitem' 	: value,
			'deletetipe'	: 'selected'
		},
		success:function(response){
			if(response.status == false)
            {
                showAlert('Oops',response.message,'error');
            }
            else
            {
                console.log('sukses');
				showList('#todo-list');
				clear();

	            array = [];
				$("#todo-i-selected").html(array.length);
            }
		}
	});
}

/*
 | ADD
 | DATA
*/
function addList()
{
	var todo 	  = $('#todo_add');
	var konten 	  = $('#konten_todo');
	var url       = todo.attr('action');
	var valid     = todo.attr('valid');
	var csrf      = todo.find('input[name="_token"]');

	var validator = $('#todo_add').validate({
    	ignore				: [],
		debug				: true,
    	errorClass			: 'error',
		errorElement		: 'em',
		errorPlacement		: function(error, element) 
		{
			error.appendTo(element.parent('div').next('p'));
		},
		highlight: function(element)
		{   
		    var text = $(element).parent('div').next('p');
		    text.find('em').removeClass('sukses').addClass('error');
		},
		unhighlight: function(element)
		{ 
		    var text = $(element).parent('div').next('p');
		    text.find('em').removeClass('error').addClass('sukses');
		},
		rules: 
		{
			'data[konten]': 
			{
				required	:true,
			},
		}, 
		messages: 
		{
	        'data[konten]' 	: 
	        {
	        	required	: 'Inputan harus diisi',
	        },
	    },
		submitHandler: function() 
		{	
			$.ajax({
				type	:'POST',
				url		:url,
				data	:{
					'_token'  		: csrf.val(),
					'list_konten' 	: konten.val()
				},
				success:function(response){
					if(response.status == false)
	                {
	                    showAlert('Oops',response.message,'error');
	                }
	                else
	                {
	                    console.log('sukses');
						showList('#todo-list');
						clear();
	                }
				}
			});
	    }
	});
}

function blockui()
{
    $.blockUI({ 
        message: $('#loadingBox'), 
        css: { 
            top 			:'30%', 
            left 			:($(window).width() - 200) /2 + 'px',
            backgroundColor :'none',
            border 			:'none',
            borderRadius 	:'100px',
            position 		:'fixed'
        } 
    }); 
}

function showAlert(title,text,type)
{
	swal(title, text, type);
}

function clear()
{
	$("#selectAll").prop('checked',false);
	$('#konten_todo').val('');
}

function isValidCode(code){
    return ($.inArray(code, array) > -1);
}