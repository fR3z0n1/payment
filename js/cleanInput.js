window.onload = function() {
	var inputValue = document.querySelectorAll('input[type=text]');

	for (let i = 0; i < inputValue.length; i++) {
		let oldPlaceholder = inputValue[i].getAttribute('placeholder');
		inputValue[i].value = "";
		inputValue[i].setAttribute('placeholder', oldPlaceholder);
	}
}
//Очищение input при обновлении