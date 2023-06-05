// jquery validate authentication
$("#signup").validate({
	rules: {
		email: {
			required: true,
			email: true,
		},
		password: {
			required: true,
			minlength: 8,
		},
		confirm_password: {
			required: true,
			minlength: 8,
			equalTo: "#password",
		},
	},
	messages: {
		email: {
			required: "Please enter an email address",
			email: "Please enter a valid email address",
		},
		password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 8 characters long",
		},
		confirm_password: {
			required: "Please confirm your password",
			minlength: "Your password must be at least 8 characters long",
			equalTo: "Password do not match",
		},
	},
	errorClass: "is-invalid",
	validClass: "is-valid",
	errorElement: "div",
	highlight: function (element, errorClass, validClass) {
		$(element).addClass(errorClass).removeClass(validClass);
		$(element.form)
			.find("label[for=" + element.id + "]")
			.addClass(errorClass);
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass(errorClass).addClass(validClass);
		$(element.form)
			.find("label[for=" + element.id + "]")
			.removeClass(errorClass);
	},
});

$("#signin").validate({
	rules: {
		email: {
			required: true,
			email: true,
		},
		password: {
			required: true,
			minlength: 8,
		},
	},
	messages: {
		email: {
			required: "Please enter an email address",
			email: "Please enter a valid email address",
		},
		password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 8 characters long",
		},
	},
	errorClass: "is-invalid",
	validClass: "is-valid",
	errorElement: "div",
	highlight: function (element, errorClass, validClass) {
		$(element).addClass(errorClass).removeClass(validClass);
		$(element.form)
			.find("label[for=" + element.id + "]")
			.addClass(errorClass);
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass(errorClass).addClass(validClass);
		$(element.form)
			.find("label[for=" + element.id + "]")
			.removeClass(errorClass);
	},
});
