document.getElementById("foot").onclick = function () {
	location.href = "https://github.com/deeepaaa/librebook"
};

document.getElementById("title").onclick = function () {
    location.href = "index.html"
};

if (!!document.getElementById("cont")) {
	cont = document.getElementById("cont")
	cont.onclick = function () {
	    alert("Puoi contattarmi all'indirizzo\n\ndpdevelopment@librebook.xyz")
	};

	cont.style.color="Blue"
}

if (!!document.getElementById("freedom")) {
	free = document.getElementById("freedom")
	free.onclick = function () {
	    location.href = "https://www.gnu.org/philosophy/free-sw.html.it"
	};

	free.style.color="Blue"
}