function IsNumeric(val) {
    return Number(parseFloat(val))==val;
}

function checkisbn() {
	e = document.getElementById('isbn')

	if (IsNumeric(e.value) && (e.value.length === 10 || e.value.length === 13))
		e.style.border = "1px solid green"
	else e.style.border = "1px solid red"
}