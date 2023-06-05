$(document).ready(function () {
	// Initialize form validation on the form
	$("#appointment-details").validate({
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

	// Define validation rules for each step of the form
	$("#appointment-details .step").each(function () {
		$(this).rules("add", {
			"data-privacy": {
				required: true,
				messages: {
					required: "Please agree to Data Protection Act 2012",
				},
			},
			fname: {
				required: true,
				messages: {
					required: "Please enter your first name",
				},
			},
			mname: {
				required: true,
				messages: {
					required: "Please enter your middle name",
				},
			},
			lname: {
				required: true,
				messages: {
					required: "Please enter your last name",
				},
			},
			email: {
				required: true,
				email: true,
				messages: {
					required: "Please enter a valid email address",
					email: "Please enter a valid email address",
				},
			},
			contact: {
				required: true,
				messages: {
					required: "Please provide a valid contact number",
				},
			},
			gender: {
				required: true,
				messages: {
					required: "Please select gender",
				},
			},
			"vulnerable-sector": {
				required: true,
				messages: {
					required: "Please select vulnerable sector",
				},
			},
			school: {
				required: true,
				messages: {
					required: "Please select school",
				},
			},
			position: {
				required: true,
				messages: {
					required: "Please select position",
				},
			},
			level: {
				required: true,
				messages: {
					required: "Please select level",
				},
			},
			division: {
				required: true,
				messages: {
					required: "Please select functional division",
				},
			},
			district: {
				required: true,
				messages: {
					required: "Please select district",
				},
			},
			visit: {
				required: true,
				messages: {
					required: "Please select Unit, Section, Office to Visit",
				},
			},
			purpose: {
				required: true,
				messages: {
					required: "Please state your purpose",
				},
			},
			"date-of-visit": {
				required: true,
				messages: {
					required: "Please select your prefered date of visit",
				},
			},
			"time-slot": {
				required: true,
				messages: {
					required: "Please select your prefered time slot",
				},
			},
			groups: {
				step: "data-privacy fname mname lname email contact gender vulnerable-sector school position level division district visit purpose date-of-visit time-slot",
			},
		});
	});

	// Show the first step of the form and hide the others
	$("#appointment-details .step:not(:first)").hide();

	// Handle "Next" button clicks
	$("#appointment-details .next-button").click(function () {
		var currentStep = $(this).closest(".step");
		var nextStep = currentStep.next(".step");

		// Validate current step before moving to the next one
		if ($("#appointment-details").valid()) {
			currentStep.hide();
			nextStep.show();
		}
	});

	// Handle "Previous" button clicks
	$("#appointment-details .prev-button").click(function () {
		var currentStep = $(this).closest(".step");
		var prevStep = currentStep.prev(".step");

		currentStep.hide();
		prevStep.show();
	});
});
