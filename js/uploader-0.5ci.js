(function($){
	$.fn.uploader = function(options){
		var plugin = this;
		plugin.settings = $.extend({
			location: '',
			uploadURL: '',
			deleteURL: ''
		},options);
		return this.each(function(){
			var object = this;
			object.fileList = $('<ul class="file-list"></ul>');
			object.dropButton = $('<a class="dropbutton dragdrop-button button" draggable="false">Browse Images</a>');
			object.dropFiles = $('<input style="display:none;" class="dropfiles" type="file" name="files[]" multiple="multiple">');
			object.dragDrop = $('<div class="drop dragdrop">Drag & Drop Images or PDFs Here</div>');
			object.lock = $('<input type="hidden" name="lock" value="false" pattern="isfalse" required>');
			//Check Browser Support
			if(window.File && window.FileList && window.FileReader && window.FormData){
				var dragDropArea = object.dragDrop.append(object.dropButton);
				object.content = $(
					'<div id="upload" class="uploader">'+
						'<div class="uploader-container">' +
							dragDropArea.outerHTML() +
							object.dropFiles.outerHTML() + 
						'</div>' +
						object.fileList.outerHTML() +
						'<div>' +
							object.lock.outerHTML() +
							'<small class="error errorlabel errorimage">Images uploading.</small>' +
						'</div>' +
					'</div>'
				);
				//Drag drop file upload button
				$(object.content).find('.dropbutton').on(
					'click',
					function(){
						object.dropFiles.click();
				}).on(
					'change',
					function(event){
						object.filedrop(event);
				});
				//Add drag drop support to div
				$(object.content).find('.dragdrop').on(
					'drop',
					function(event){
						var original = event.originalEvent;
						object.filedrop(original);
				}).on(
					'dragleave',
					function(event){
						object.filedragleave(event);
				}).on(
					'dragover',
					function(event){
						object.filedragover(event);
				});
				$(object).append(object.content);
			}else{
				console.log('This browser does not support Wolf Uploader.');
			}
			//Drag over event
			object.filedragover = function(event){
				event.stopPropagation();
				event.preventDefault();
				$(event.target).addClass('filehover');
			}
			//Drag leave event
			object.filedragleave = function(event){
				event.stopPropagation();
				event.preventDefault();
				$(event.target).removeClass('filehover');
			}
			//Drag drop event
			object.filedrop = function(event){
				event.stopPropagation();
				event.preventDefault();
				$(event.target).removeClass('filehover');
				if(event.dataTransfer){
					if(event.dataTransfer.files.length) {
						var files = event.dataTransfer.files;
						for(var index = 0, file; file = files[index]; index++){
							object.upload(event.target,file);
						}
					}   
				}else{
					if(event.target.files.length){
						var files = event.target.files;
						for(var index = 0, file; file = files[index]; index++){
							object.upload(event.target,file);
						}
					}  
				}
			}
			//Upload file(s) on drop/or on file(s) select in file explorer - submits to upload file
			object.upload = function(target,file){
				var meter = $('<div class="progress"><span class="meter" style="width:1%;"></span></div>');
				var html = $(
				'<li class="medium-2 columns working">' +
					'<div class="image">' +
						'<span class="remove">x</span>' +
						meter.outerHTML() +
						'<img class="thumbnail" width="100%" src="' + plugin.settings.location + '/img/uploadfile.png">' +
					'</div>' +
				'</li>');
				var reader = new FileReader();
				reader.readAsDataURL(file)
				$(object.content).find('ul').append(html);
				$(object.lock).val('true');
				object.load_remove();
				var xhr = new XMLHttpRequest();
				var formdata = new FormData();
				if(xhr.upload){
					xhr.onload = function(event){
						if(this.readyState == 4 && this.status == 200){
							try{
								var response = $.parseJSON(this.responseText);
								var container = html.find('.image');
								if(response.error === 0){
									container.append('<input class="image_id" name="file_ids[]" type="hidden" value="' + response.image_id + '">');
									container.children('img').attr('src',response.thumbnail);
									container.append('<h6>' + response.title + '</h6>');
								}else{
									container.children('img').attr('src',plugin.settings.location + '/img/fileerror.png');
								}
								$(object.lock).val('false');
								container.find('.progress').hide();
								$(object.fileList).sortable();
							}catch(error){
								
							}
						}
					};
					xhr.upload.onprogress = function(event){
						if(event.lengthComputable){
							$(html).find('.meter').css({'width':((event.loaded / event.total) * 100) + '%'});
						}
					};
					formdata.append("files",file);
					xhr.open('POST',plugin.settings.uploadURL);
					xhr.send(formdata);
				}
			}
			object.load_remove = function(){
				$('.remove').click(function(){
					var button = this;
					$(object.lock).val('true');
					var container = $(button).parent().parent();
					container.hide();
					var image_id = $(button).siblings('img').data('image-id');
					if(image_id == ""){
						image_id = $(button).find('.image_id').val();
					}
					if(image_id != undefined){
						$.ajax({
							url: plugin.settings.deleteUrl,
							type: 'POST',
							data:{
								id: image_id
							},
							success: function(data){
								data = $.parseJSON(data);
								if(data.error == 0){
									$(object.lock).val('false');
									container.remove();
								}else{
									container.show();
								}
								$(object.fileList).sortable();
							}
						});
					}
				});
			}
		});
	};
	$.fn.outerHTML = function(s) {
		return (s)
		? this.before(s).remove()
		: jQuery("<p>").append(this.eq(0).clone()).html();
	};
})(jQuery);