let input_num_arr = document.querySelectorAll('input[data-format=number]');

	for (var i = 0; i < input_num_arr.length; i++) {
		input_num_arr[i].addEventListener('keypress', function () {
		if(event.keyCode < 48 || event.keyCode > 57)
			event.returnValue = false;
		});
	}
