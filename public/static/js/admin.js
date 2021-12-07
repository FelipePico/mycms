var base= location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
	var btn_search = document.getElementById('btn_search');
	var form_search = document.getElementById('form_search');
	if(btn_search){
		btn_search.addEventListener('click', function(e){
			e.preventDefault();
			if(form_search.style.display === 'block'){
				form_search.style.display = 'none';
			}else{
				form_search.style.display = 'block';
			}
		});
	}
	if(route == "product_edit" ){
		var btn_product_file_image = document.getElementById('btn_product_file_image');
		var product_file_image = document.getElementById('product_file_image');
		btn_product_file_image.addEventListener('click', function(){
			product_file_image.click();
		}, false);
		product_file_image.addEventListener('change', function(){
			document.getElementById('form_product_gallery').submit();
		});
	}
	route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

	btn_deleted = document.getElementsByClassName('btn-deleted');
	for(i=0; i < btn_deleted.length; i++){
		btn_deleted[i].addEventListener('click', delete_object);
	}

});

$(document).ready(function(){
	editor_init('editor');
})

function editor_init(field){
	
	CKEDITOR.replace(field,{
		toolbar: [
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote'] }, 
		{ name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'Preview', 'Source'] }
		]
	});
}

function delete_object(e){
		e.preventDefault();
		var object = this.getAttribute('data-object');
		var action = this.getAttribute('data-action');
		var path = this.getAttribute('data-path');
		var url = base + '/mycms/public/' + path + '/' + object + '/' + action ;//cuando haga el servidor, debo quitar el mycms/public/
		var title, text, icon, confirmText, resultTextTitle, resultTextMsg;

		if (action == 'delete') {
			title = '¿Estás seguro de eliminar este elemento?';
			text = 'Recuerda que esta acción, enviará este item a la papelera';
			icon = 'warning';
		}
		if (action == 'restore') {
			title = '¿Estás seguro de restaurar este elemento?';
			text = 'Recuerda que esta acción, quitará este item de la papelera';
			icon = 'info';
		}
		Swal.fire({
		  	title: title,
			text: text,
			icon: icon,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33'
		}).then((result) =>{
		  if (result.isConfirmed) {
		  	window.location.href = url;
		  } 
		});
		

	}