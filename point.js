function highlight() {

	for (q of document.getElementsByClassName('q'))
		q.style.background = '#ffffff'

	if (hash = location.hash)
		document.getElementById(hash.replace(/^#/, '')).style.background = '#c0ffff'
}

function book(event) {
	event = event || window.event

	location.hash = '#' + event.target.id
	highlight()
}

highlight()