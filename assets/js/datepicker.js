$("#date-of-visit").flatpickr({
	enableTime: false,
	minDate: "today",
	disableMobile: true,
	onChange: function () {
		var csrf_name = $("#csrf").attr("name");
		var csrf_value = $("#csrf").val();
		var data = {
			[csrf_name]: csrf_value,
			date: $("#date-of-visit").val(),
		};
		$.ajax({
			url: $("#date-of-visit").data("link"),
			type: "post",
			data: data,
			dataType: "text",
			success: function (response) {
				var res = JSON.parse(response);
				$("#csrf").attr("name", res.csrf.name);
				$("#csrf").val(res.csrf.hash);
				$("#time-slots").removeClass("d-none");
				$("#time-slots").html(res.time_slots);

				let isHovering = false;
				const timeSlots = document.querySelectorAll(".time-slot");
				const selectedTimeSlotInput =
					document.getElementById("selected-time-slot");

				timeSlots.forEach((slot) => {
					let availability = slot.getAttribute("data-availability");
					if (availability === "false") {
						slot.style.cursor = "not-allowed";
					} else {
						slot.style.cursor = "pointer";

						slot.addEventListener("click", (event) => {
							selectedTimeSlotInput.value =
								slot.getAttribute("data-time-slot-id");

							timeSlots.forEach((s) => {
								s.classList.remove("selected", "bg-primary", "text-white");
							});

							if (availability !== "false") {
								slot.classList.add("selected", "bg-primary", "text-white");
							}

							isHovering = false;
						});
					}

					slot.addEventListener("mouseover", (event) => {
						isHovering = true;
						if (availability === "false") {
							slot.classList.remove("bg-primary");
							event.preventDefault();
						} else {
							slot.classList.add("bg-primary");
							slot.classList.add("text-white");
						}
					});

					slot.addEventListener("mouseout", (event) => {
						if (!slot.classList.contains("selected") && isHovering) {
							slot.classList.remove("bg-primary", "text-white");
						}
					});
				});
			},
		});
	},
});

$("#time-slot-add").flatpickr({
	enableTime: true,
	noCalendar: true,
	disableMobile: true,
	dateFormat: "h:i K",
	minTime: "08:00",
	maxTime: "17:00",
});

$("#time-slot-up").flatpickr({
	enableTime: true,
	noCalendar: true,
	disableMobile: true,
	dateFormat: "h:i K",
	minTime: "08:00",
	maxTime: "17:00",
});

$("#reschedule-appointment").click(function () {
	$("#show-edit-details").click();
});
