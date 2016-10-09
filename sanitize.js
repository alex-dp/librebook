function replaceAll(a, b, c) {
	return a.replace(new RegExp(b, 'g'), c)
}

function IsNumeric(a) {
	return Number(parseFloat(a)) == a
}

function checkisbn() {
	e = document.getElementById('isbn')
	sane = replaceAll(e.value, /[ -]/, '')

	sane.length == 0 ?
		(e.style.border = '1px solid cadetblue', e.style.background = "white") :
			!IsNumeric(sane) || 10 !== sane.length && 13 !== sane.length ?
				(e.style.border = "1px solid red", e.style.background = "pink") :
				(e.style.border = "1px solid green", e.style.background = "lightgreen")
}