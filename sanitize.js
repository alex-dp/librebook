function replaceAll(str, find, replace) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function IsNumeric(val) {
    return Number(parseFloat(val))==val;
}

function checkisbn() {
	e = document.getElementById('isbn')

	sane = replaceAll(e.value, '-', '')
	sane = replaceAll(sane, ' ', '')

	if (IsNumeric(sane) && (sane.length === 10 || sane.length === 13))
		e.style.border = "1px solid green"
	else e.style.border = "1px solid red"
}