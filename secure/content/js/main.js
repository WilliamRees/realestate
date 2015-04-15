window.re = {};
re.views = {};
re.views.shared = {};
re.views.secure = {};
re.api = {};
re.utilities = {};

re.global = (function($){

	var init = function () {
		re.api.dataApi.init();
		if (typeof(Ladda)!== typeof(undefined)) {
			Ladda.bind( 'input[type=submit]');	
		}
	};

	return {
		init: init
	}

})(jQuery);

$(function(){
	re.global.init();
});

re.views.shared.forms = (function ($){
	var init = function (options) {
		setjQueryValidateDefaults();
		options = (options === undefined) ? {} : options;
		$('form').validate(options);
		bindEvents();
	};

	var bindEvents = function () {
		$('form input[type="submit"]').on('click', function (e){

		});
	};

	var setjQueryValidateDefaults = function(){
		//Set jQuery Validate Defaults
		$.validator.setDefaults({
		    highlight: function(element) {
		        $(element).closest('.form-group').addClass('has-error');
		    },
		    unhighlight: function(element) {
		        $(element).closest('.form-group').removeClass('has-error');
		    },
		    errorElement: 'span',
		    errorClass: 'help-block',
		    errorPlacement: function(error, element) {
		        if(element.parent('.input-group').length) {
		            error.insertAfter(element.parent());
		        } else {
		            error.insertAfter(element);
		        }
		    }
		});
	};

	return {
		init: init
	}
})(jQuery);

re.views.secure.login = (function($){
    
	var formhash = function (form, password) {
	    // Create a new element input, this will be our hashed password field. 
	    var p = document.createElement("input");
	 
	    // Add the new element to our form. 
	    form.appendChild(p);
	    p.name = "p";
	    p.type = "hidden";
	    p.value = hex_sha512(password.value);
	 
	    // Make sure the plaintext password doesn't get sent. 
	    password.value = "";
	 
	    // Finally submit the form. 
	   
	};

	var init = function() {
		re.views.shared.forms.init();
		bindEvents();
	};

	var bindEvents = function () {
		$("#LoginForm").on('submit', function(e){
			var $this = $(this);
	        var isvalidate= $this.valid();
	        if(isvalidate)
	        {
	            e.preventDefault();
	            formhash($this[0], $this[0].password);	            
	            $this[0].submit();
	        }
	    });
	};

	return {
		formhash: formhash,
		init: init
	}


})(jQuery);

re.views.secure.users = (function($) {
	var register = (function ($){
		var init = function () {
			var options = {
				rules: {
			        password: 'required',
			        confirmpwd: {
			            equalTo: '#password'
			        }
		    	}
			};
			re.views.shared.forms.init(options);
			bindEvents();
		};

		function bindEvents() {
			$('#RegisterForm').on('submit', function(e){
				var $this = $(this);
		        var isvalidate= $this.valid();
		        if(isvalidate)
		        {
		            e.preventDefault();
		            regformhash($this[0], $this[0].username, $this[0].email, $this[0].password, $this[0].confirmpwd);	            
		            $this[0].submit();
		        }
			});
		}

		function regformhash(form, uid, email, password, conf) {
		    // Create a new element input, this will be our hashed password field. 
		    var p = document.createElement("input");
		 
		    // Add the new element to our form. 
		    form.appendChild(p);
		    p.name = "p";
		    p.type = "hidden";
		    p.value = hex_sha512(password.value);
		 
		    // Make sure the plaintext password doesn't get sent. 
		    password.value = "";
		    conf.value = "";
		 
		    // Finally submit the form. 
		    form.submit();
		    return true;
		};

		return {
			init: init
		}

	})($);

	return {
		register: register
	}
})(jQuery);

re.notification = (function($){
	var show = function(context, message, status, autoHide, scrollToTop) {
		$notification = $(context);
		$alert = $notification.find('.alert');
		$alert.addClass(status);
		$alert.empty().html(message);
		$notification.show();	
		if (scrollToTop) {
			$('html,body').animate({
		      scrollTop: 0
		    }, 1);	
		}
		

		if (autoHide) {
			setTimeout(function(){
				hide(context);
			}, 5000);
		}
	}
	var hide = function (context) {
		$notification = $(context);
		$notification.fadeOut('slow');
	}
	return {
		show: show
	}
})(jQuery);

re.utilities = (function($) {
	var defaults = {
		clearOnSubmit: false,
		formId: null
	};
	var _get = function (url) {
		var deferred = $.Deferred();
		$.ajax({
		  	type: "GET",
		  	url: url,
		  	cache: false,
		  	success: function (response) {
		  		if (response.Success) {
		  			deferred.resolve(response);	
		  		} else {
		  			handelFailer(response);
		  			deferred.reject(response.Errors);
		  		}
		  	},
		  	error: function(d, textStatus, error){
  				redirectToErrorView();
	  		}
		});
		return deferred.promise();
	};

	var _post = function (url, data, options) {
		var deferred = $.Deferred();
		$.ajax({
		  	type: "POST",
		  	url: url,
		  	cache: false,
		  	data: data,
		  	success: function (response) {
		  		if (response.Success) {
	  				handleSuccess(response, options);
		  			deferred.resolve(response);	
		  		} else {
		  			handelFailer(response);
		  			deferred.reject(response.Errors);
		  		}
		  	},
		  	error: function(d, textStatus, error){
  				redirectToErrorView();
	  		}
		});
		return deferred.promise();
	};

	var _put = function (url, data, options) {
		var deferred = $.Deferred();
		$.ajax({
		  	type: "PUT",
		  	url: url,
		  	cache: false,
		  	data: data,
		  	success: function (response) {
		  		if (response.Success) {
	  				handleSuccess(response, options);
		  			deferred.resolve(response);	
		  		} else {
		  			handelFailer(response);
		  			deferred.reject(response.Errors);
		  		}
		  	},
		  	error: function(d, textStatus, error){
  				redirectToErrorView();
	  		}
		});
		return deferred.promise();
	};

	var _delete = function (url, data) {
		var deferred = $.Deferred();
		$.ajax({
		  	type: "DELETE",
		  	url: url,
		  	data: data,
		  	success: function (response) {
		  		if (response.Success) {
		  			deferred.resolve(response);	
		  		} else {
		  			handelFailer(response);
		  			deferred.reject(response.Errors);
		  		}
		  	},
		  	error: function(d, textStatus, error){
  				redirectToErrorView();
	  		}
		});

		return deferred.promise();
	};

	function handleSuccess(response, options) {
		var settings = $.extend(defaults, options);
		if (settings.clearOnSubmit) {
			$form = $('#' + settings.formId);
			$form.trigger("reset");
		}			
	}

	function handelFailer(response) {
		window.tempResponse = response;
		$errorSummary = $("#ErrorSummary");
		$errorSummaryInner = $("#ErrorSummary .inner");

		if (response.Errors.length == 1) {
			$errorSummaryInner.empty().html(response.Errors[0]);
			$errorSummary.removeClass('show');
			$errorSummary.addClass('show');

			window.scrollTo(0,0);

		} else if (response.Errors.length > 1) {
			response.Errors.forEach(function (item) {

			});
		}

		window.scrollTo(0, $errorSummary.offset().top - 20);
	}

	function redirectToErrorView() {
		window.location.href = SITE_ROOT + '/error.php';
	}

	return {
		post: _post,
		delete: _delete,
		get: _get,
		put: _put
	}
})(jQuery);

re.api.cms = (function($){
	var uri = SITE_ROOT + 'secure/cms';

	var update = function(data) {
		return re.utilities.post(uri + "/update.php", data);
	};

	return {
		update: update
	}
})(jQuery);

re.api.listing = (function($) {
	var uri = SITE_ROOT + 'api/listing/';

	var get = function (id, page, pagesize) {
		var url = "index.php";
		if (id !== undefined && id !== null) {
			url = uri + "?Id=" + id;
		} else {
			if ((page !== undefined && page !== null) && (pagesize !== undefined && pagesize !== null)) {
				url = uri + "?page={0}&pagesize={1}".replace('{0}', page).replace('{1}', pagesize);
			} else {
				url = uri;
			}
		}

		return re.utilities.get(url);
	}

	var add = function (listing, options) {
		return re.utilities.post(uri + "index.php", listing, options);
	};

	var update = function (listing, options) {
		return re.utilities.put(uri + "index.php", listing, options)
	};

	var remove = function (id) {
		return re.utilities.delete(uri + "index.php", {Id: id});
	};

	var statuses = function (status, value, id) {
		var url = uri + "statuses.php?status={0}&value={1}&id={2}";
		url = url.replace('{0}', status);
		url = url.replace('{1}', value);
		url = url.replace('{2}', id);
		return re.utilities.get(url);
	}

	var search = function (searchText, addressesOnly) {
		addressesOnly = (addressesOnly === undefined) ? false : addressesOnly;
		var url = uri + "searchByAddress.php?SearchText=" + searchText + "&ShowAddressOnly=" + addressesOnly;
		return re.utilities.get(url);
	}

	var image = {
		uri: SITE_ROOT + 'api/listing/images.php',
		remove: function (listingId, fileName) {

			var data = {
				Id: listingId,
				FileName: fileName
			}
			return re.utilities.delete(this.uri, data);
		}
	};

	return {
		remove: remove,
		search: search,
		statuses: statuses,
		get: get,
		add: add,
		update: update,
		image: image
	};

})(jQuery);

re.api.dataApi = (function($){
	var init = function () {
		listing.init();
		listing.image.init();
	};

	var $doc = $(document);

	var listing = {
		init: function () {

			//Remove button click event
			$doc.on('click', '*[data-listing-remove]', function (e) {
				e.preventDefault();
				$this = $(this);
				re.api.listing.remove($this.data('listing-remove'))
				.done(function (){
					$this.trigger('listing.removed');
				})
				.fail(function (){
					$this.trigger('listing.removed.error');
				});
			});
		},
		image: {
			init: function() {
				$doc.on('click', '*[data-listing-image-remove]', function (e){
					e.preventDefault();
					$this = $(this);			
					re.api.listing.image.remove($this.data('listing-id'), $this.data('listing-image-remove'))
					.done(function(){
						$($this.data('listing-image-remove-target')).remove();
					}); 
				});
			}
		}
	};



	return {
		init: init
	};
})(jQuery);

re.views.secure.cms = (function($) {
	//Reference for all editors on the page.
	var editors;

	//Default configuration for all editors
	var config = {
	   ui : {
	    toolbar : {
	        items : [
	            // Limit the toolbar to insert, styles and emphasis
	            'insert',
	            'style',
	            'emphasis',
	            {
	            	label: 'Indent Group',
            		items: ['indent', 'outdent']
	            },
	            {
	                label: 'Custom Toolbar Group',
	                items: [ 'removeformat', 'fullscreen' ]
	            }
	        ]
	    }
	  }
	};

	//helper to save content
	var saveEditorContent = function() {
		for (var i = 0; i < editors.length; i++)
		{
			var editor = editors[i];	
			//re.api.cms.update();
			var nodeName = $('.cms-content').eq(i).data('nodename');
			var content = editor.content.get();
			re.api.cms.update({
				Name: nodeName,
				Data: content
			});
		}	
	};

	var init = function() {
		$(function(){
			editors = textboxio.inlineAll('.cms-content', config);
			bindEvents();
		});
	};

	var bindEvents = function(){
		$('#SaveContentChanges').on('click', function(e){
			e.preventDefault();
			saveEditorContent();
		});
	}

	return {
		init: init
	};
})(jQuery);

re.views.secure.listing = (function($) {

	var helpers = {
		getFormValues: function () {
			var data = {
			  	Address: $('#Address').val(),
			  	City: $('#City').val(),
			  	Province: $('#Province').val(),
			  	Description: $('#Description').val(),
			  	Price: $('#Price').val(),
			  	PropertyType: $('#PropertyType').val(),
			  	Bedrooms: $('#Bedrooms').val(),
			  	Bathrooms: $('#Bathrooms').val(),
			  	LivingSpace: $('#LivingSpace').val(),
			  	LandSize: $('#LandSize').val(),
			  	TaxYear: $('#TaxYear').val(),
			  	Taxes: $('#Taxes').val(),
			  	BuildingAge: $('#BuildingAge').val(),
			  	Id: $('#ListingId').val(),
			  	Published: $('#Published').prop('checked'),
			  	New: $('#New').prop('checked'),
			  	Sold: $('#Sold').prop('checked'),
			  	Latitude: $('#Latitude').val(),
			  	Longitude: $('#Lonitude').val(),
			  	Featured: $('#Featured').prop('checked'),
			  	FeaturedImage: $('input[name="FeaturedImage"]:checked').data('image-name')
		  	};

		  	return data;
		},
		dropzone: {
			//removedFile callback
			removedFile: function(file) {
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			},

			//accept callback
			accept: function(file, done) {
				done();
			},

			//helper
			toggleUploadBtns: function() {
				
			},
			init: function() {
				var deferred = $.Deferred();
				Dropzone.autoDiscover = false;
				$(function(){
					re.views.shared.forms.init();

					var previewNode = document.querySelector("#template");
					previewNode.id = "";
					var previewTemplate = previewNode.innerHTML;
					previewNode.parentNode.removeChild(previewNode);
					var dropzone = new Dropzone("div#NewListingDropZone", { 
						url: SITE_ROOT + "/api/listing/images.php",
						paramName: 'file',
					    addRemoveLinks: false,
					    accept: helpers.dropzone.accept,
					    acceptedFiles: "image/*",
					    maxFilesize: 2, // MB
					    autoProcessQueue: false,
					    removedfile: helpers.dropzone.removedFile,
				      	thumbnailWidth: 80,
						thumbnailHeight: 80,
						previewTemplate: previewTemplate,
						previewsContainer: "#Dropzone-Preview", // Define the container to display the previews
	  					clickable: "*[dz-clickable]", // Define the element that should be used as click trigger to select files.
	  					dictDefaultMessage: ""
					});
					deferred.resolve(dropzone);	
					
				});

				if ($("#Featured").prop('checked')) {
					$('div#NewListingDropZone').addClass('featured');
				}

				return deferred.promise();
			},
			prossesDropzone: function (dropzone, id) {
				if (dropzone.getAcceptedFiles().length > 0) {

		  			dropzone.on("sending", function (file, xhr, formData) {
						formData.append("ListingId", id);
						var $previewElement = $(file.previewElement);
						if ($('#Featured').prop('checked') && $previewElement.find('input[name="FeaturedImage"]').prop('checked')){
							formData.append("FeaturedImage", true);
						} else {
							formData.append("FeaturedImage", false);
						}
					});

		  			dropzone.options.autoProcessQueue = true;
	  				dropzone.processQueue(); 		
		  		}
			},
			bindEvents: function (dropzone) {
				// Update the total progress bar
				dropzone.on("totaluploadprogress", function(progress) {
				  //document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
				});
				 
				// Hide the total progress bar when nothing's uploading anymore
				dropzone.on("queuecomplete", function(progress) {
				  //document.querySelector("#total-progress").style.opacity = "0";
				  dropzone.options.autoProcessQueue = false;
				});

				dropzone.on('addedfile', function (file) {
					if (dropzone.files.length > 0) {
						$('#Dropzone-DefaultText').hide();
					}
				});

				dropzone.on('removedfile', function (file) {
					if (dropzone.files.length === 0) {
						$('#Dropzone-DefaultText').show();
					}
				});

				$('#Featured').on('change', function(){
					if ($('#Featured').prop('checked')) {
						$('div#NewListingDropZone').addClass('featured');	
					} else {
						$('div#NewListingDropZone').removeClass('featured');
					}
				});
			}
		}
	};

	var bindEvents = function () {
		$("img.lazy").lazyload({
		    threshold : 200
		});
		$('*[data-listing-remove]').on('listing.removed', function() {
			$this = $(this);
			$this.parents('.thumbnail').parent().remove();
		});
	};

	var init = function () {
		
		$(function(){
			re.views.shared.forms.init()
			bindEvents();
			//Query addresses and initialize address typeahead.
			re.api.listing.search("", true).done(function(response) {
				$('#ListingSearchInput').typeahead({
				    order: "desc",
				    minLength: 1,
				    maxItem: 50,
				    selector: {
				        filter: "input-group-btn",
				        filterButton: "btn btn-default",
				        dropdown: "dropdown-menu dropdown-menu-right",
				        list: "dropdown-menu",
				        hint: "form-control"
				    },
				    source: {
				    	data : response.Data
				    },
				    callback: {
				        onInit: function (node) {
				        },
				        onClick: function (node, a, object) {
				            if (object.display.length > 0) {
				            	$(node).parents('form').submit();
				            }
				        }
				    }
				});
			});
			
			//Address search submit
			$('#ListingSearchForm').on('submit', function(e){
				e.preventDefault();
				if ($(this).valid()) {
					var searchText = $('#ListingSearchInput').val();
					$('.thumbnail').each(function(){
						var $this = $(this);
						if ($this.data('address').indexOf(searchText) > -1) {
							$this.parent().show();
						} else {
							$this.parent().hide();
						}
					});
				}
			});

			$('#PublishedFilter').on('change', function(e){
				var filterVal = this.options[this.selectedIndex].value;
				$('#ListingSearchInput').val('');

				$('.thumbnail').each(function(){
						var $this = $(this);
						if ($this.find('#Published').prop('checked') && filterVal === 'published') {
							$this.parent().show();
						}
						else if (!$this.find('#Published').prop('checked') && filterVal === 'unpublished') {
							$this.parent().show();
						} else if (filterVal === "all") {
							$this.parent().show();
						}
						 else {
							$this.parent().hide();
						}	
					});
			});

			$('#StatusForms form input[type="checkbox"]').on('change', function(e) {
				var $this = $(this);
				var $form = $this.parents('form');
				
				var status = $form.find('input[name="status"]').val();
				var id = $form.find('input[name="id"]').val();
				var value = $this.prop("checked") ? 1 : 0;
				
				if (status === "published" && value === 1) {
					$this.prop('checked', false);

					var getListing = re.api.listing.get(id);


					var validateListing = getListing.then(function(response) {
						var deferred = $.Deferred();
						if (response.Success) {
							var listing = response.Data;
							console.log(listing);
							var errors = [];
							for (var property in listing) {
							    if (listing.hasOwnProperty(property)) {

							        if (Object.prototype.toString.call(listing[property]) === '[object Array]') {
							        	if (listing[property].length === 0) {
							        		errors.push(property);
							        	}
							        } else if (property !== "FeaturedImage") {
							        	if (listing[property] === null || listing[property].length === 0) {
							        		errors.push(property);
							        	}
							        }
							    }
							}

							if (errors.length > 0) {
								deferred.reject(errors);
							} else {
								deferred.resolve();
							}

						} else {
							deferred.reject();
						}
						return deferred.promise();
					});

					var validateResult = validateListing.fail(function(errors) {
						var deferred = $.Deferred();
						if (errors.length > 0) {
							var $publishConfirmation = $('#PublishConfirmation');
							var errorHtml = "";
							errors.forEach(function(item, index, arr) {
								errorHtml += "<li>" + item + "</li>";	
							});
							$publishConfirmation.find('ul').html(errorHtml);
							$publishConfirmation.modal({
								show: true
							});

							$publishConfirmation.find('.btn-primary').on('click', function(){
								$publishConfirmation.modal('hide');
								re.api.listing.statuses(status, value, id);		
								$this.prop('checked', true);
							});
						}
						return deferred.promise();
					})
					.done(function() {
						$this.prop('checked', !$this.prop('checked'));
						re.api.listing.statuses(status, value, id);		
					});
				} else {
					re.api.listing.statuses(status, value, id);	
				}


			});
		});
	};

	

	var newlisting = (function ($){
		
		var myDropzone;
		var uploadStatus;

		var init = function() {
			Dropzone.autoDiscover = false;
			$(function(){
				re.views.shared.forms.init();

				var previewNode = document.querySelector("#template");
				previewNode.id = "";
				var previewTemplate = previewNode.innerHTML;
				previewNode.parentNode.removeChild(previewNode);

				myDropzone = new Dropzone("div#NewListingDropZone", { 
					url: SITE_ROOT + "/api/listing/images.php",
					paramName: 'file',
				    addRemoveLinks: false,
				    accept: accept,
				    acceptedFiles: "image/*",
				    maxFilesize: 2, // MB
				    autoProcessQueue: false,
				    removedfile: removedFile,
			      	thumbnailWidth: 80,
					thumbnailHeight: 80,
					previewTemplate: previewTemplate,
					previewsContainer: "#Dropzone-Preview", // Define the container to display the previews
  					clickable: "*[dz-clickable]", // Define the element that should be used as click trigger to select files.
  					dictDefaultMessage: ""
				});
				bindEvents();
			});
			
		};

		function bindEvents() {
			helpers.dropzone.bindEvents(myDropzone);
			 
			// Setup the buttons for all transfers
			// The "add files" button doesn't need to be setup because the config
			// `clickable` has already been specified.
			document.querySelector("#Submit").onclick = function(e) {
				e.preventDefault();
				if ($('#NewListing').valid()) {		
					var l = Ladda.create(this);
	 				l.start();		
					re.api.listing.add(helpers.getFormValues())
					.done(function(response) {
						if (response.Success) {
							if (myDropzone.files.length > 0) {
								myDropzone.on('error', function(file) {
									uploadStatus = "error";
									myDropzone.off('error');
								});
								helpers.dropzone.prossesDropzone(myDropzone, response.Data.Id);
								myDropzone.on('queuecomplete', function(){
									setTimeout(function(){
										l.stop();
										if (uploadStatus !== "error") {
											$('#NewListing').trigger("reset");
											myDropzone.removeAllFiles();			
										}
										
										re.notification.show("#Notification", '<strong>Success!</strong> ' + response.Data.Address + ' was updated', 'alert-success', true, false);
									}, 500);
									
								});	
							} else {
								setTimeout(function(){
									l.stop();
									$('#NewListing').trigger("reset");
									re.notification.show("#Notification", '<strong>Success!</strong> ' + response.Data.Address + ' was updated', 'alert-success', true, false);
								}, 500);
							}
						}
					});
				}
			};



			document.querySelector("#Dropzone-Actions .cancel").onclick = function() {
			  myDropzone.removeAllFiles(true);
			};

			$(document).on('click', '.delete', function(e) {
				var $this = $(this);
				var fileName = $this.parents('.file-row').find('*[data-dz-name]').text();
				$.ajax({
				    url: 'index.php',
				    type: 'DELETE',
				    data: { FileName: fileName },
				    success: function(result) {
				        toggleUploadBtns();
				    }
				});
			});

			
		}

		function removedFile(file) {
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		}

		function accept(file, done) {
			done();
			toggleUploadBtns();
		}

		function toggleUploadBtns() {
			if (myDropzone.getAcceptedFiles().length > 0) {
				$('#actions .start').show();
				$('#actions .cancel').show();
			} else {
				$('#actions .start').hide();
				$('#actions .cancel').hide();
			}
		}
		return {
			init: init
		}

	})($);

	var editlisting = (function ($){
		
		var myDropzone;
		var uploadStatus;

		var init = function() {
			myDropzone = helpers.dropzone.init()
			.done(function(dropzone) {
				myDropzone = dropzone;
				bindEvents();
			});
		};

		function bindEvents() {
			helpers.dropzone.bindEvents(myDropzone);
			 
			// Setup the buttons for all transfers
			// The "add files" button doesn't need to be setup because the config
			// `clickable` has already been specified.
			document.querySelector("#Submit").onclick = function(e) {
				e.preventDefault();
				if ($('#EditListingForm').valid()) {		
					var l = Ladda.create(this);
	 				l.start();		
					re.api.listing.update(helpers.getFormValues())
					.done(function(response) {
						if (response.Success) {
							if (myDropzone.files.length > 0) {
								myDropzone.on('error', function(file) {
									uploadStatus = "error";
									myDropzone.off('error');
								});
								helpers.dropzone.prossesDropzone(myDropzone, response.Data.Id);
								myDropzone.on('queuecomplete', function(){
									setTimeout(function(){
										l.stop();
										if (uploadStatus !== "error") {
											myDropzone.removeAllFiles();			
										}
										re.notification.show("#Notification", '<strong>Success!</strong> ' + response.Data.Address + ' was created', 'alert-success', true, false);
									}, 500);
									
								});	
							} else {
								setTimeout(function(){
									l.stop();
									re.notification.show("#Notification", '<strong>Success!</strong> ' + response.Data.Address + ' was created', 'alert-success', true, false);
								}, 500);
							}
						}
					})
					.fail(function(response) {
						setTimeout(function(){
							l.stop();
							re.notification.show("#Notification", '<strong>Success!</strong> ' + response.Data.Address + ' was created', 'alert-success', true, false);
						}, 500);
					});
				}
			};

			myDropzone.on('success', function(file, xhr){
				var filename = file.name;
				var $template = $('#ListingImageTemplate').clone();
				$template.attr('id', (parseInt($template.attr('id')) + 1));
				$template.find('img').attr('src', SITE_ROOT + '/uploads/' + filename);
				$template.find('.name').html(filename);
				$button = $template.find('button');
				$button.attr('data-listing-image-remove-target', '#' + (parseInt($template.attr('id')) + 1));
				$button.attr('data-listing-image-remove', filename);
				if ($('.listing-image').last().length > 0) {
					$('.listing-image').last().after($template);	
				} else {
					$('#Dropzone-DefaultText').before($template);
				}
				
				myDropzone.removeFile(file);
			});
		}

		
		return {
			init: init
		}

	})($);

	return {
		init: init,
		newlisting: newlisting,
		editlisting: editlisting
	};
})(jQuery);