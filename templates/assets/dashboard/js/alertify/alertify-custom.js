function reset() {
	$("#toggleCSS").attr("href", "../themes/alertify.default.css"), alertify.set({
		labels: {
			ok: "OK",
			cancel: "Cancel"
		},
		delay: 5e3,
		buttonReverse: !1,
		buttonFocus: "ok"
	})
}


$("#alert").on("click", function () {
	return reset(), alertify.alert("This is an alert dialog"), !1
}), 


$("#has_pending_upgrade").on("click", function () {
	return reset(), alertify.alert("This is an alert dialog"), !1
}), 



$("#confirm").on("click", function () {
	return reset(), alertify.confirm("This is a confirm dialog", function (a) {
		a ? alertify.success("You've clicked OK") : alertify.error("You've clicked Cancel")
	}), !1
}), 

$("#prompt").on("click", function () {
	return reset(), alertify.prompt("This is a prompt dialog", function (a, b) {
		a ? alertify.success("You've clicked OK and typed: " + b) : alertify.error("You've clicked Cancel")
	}, "Default Value"), !1
}), 

$("#ajax").on("click", function () {
	reset(), alertify.confirm("Confirm?", function (a) {
		a ? alertify.alert("Successful AJAX after OK") : alertify.alert("Successful AJAX after Cancel")
	})
}), 

$("#notification").on("click", function () {
	return reset(), alertify.log("Standard log message"), !1
}), 


$("#success").on("click", function () {
	return reset(), alertify.success("Success log message"), !1
}), 

$("#error").on("click", function () {
	return reset(), alertify.error("Error log message"), !1
}), 

$("#delay").on("click", function () {
	return reset(), alertify.set({
		delay: 1e4
	}), alertify.log("Hiding in 10 seconds"), !1
}), 

$("#forever").on("click", function () {
	return reset(), alertify.log("Will stay until clicked", "", 0), !1
}), 

$("#labels").on("click", function () {
	return reset(), alertify.set({
		labels: {
			ok: "Accept",
			cancel: "Deny"
		}
	}), alertify.confirm("Confirm dialog with custom button labels", function (a) {
		a ? alertify.success("You've clicked OK") : alertify.error("You've clicked Cancel")
	}), !1
}), 


$("#focus").on("click", function () {
	return reset(), alertify.set({
		buttonFocus: "cancel"
	}), alertify.confirm("Confirm dialog with cancel button focused", function (a) {
		a ? alertify.success("You've clicked OK") : alertify.error("You've clicked Cancel")
	}), !1
}), 


$("#order").on("click", function () {
	return reset(), alertify.set({
		buttonReverse: !0
	}), alertify.confirm("Confirm dialog with reversed button order", function (a) {
		a ? alertify.success("You've clicked OK") : alertify.error("You've clicked Cancel")
	}), !1
}), 


$("#custom").on("click", function () {
	return reset(), 
	alertify.custom = alertify.extend("custom"), 
	alertify.custom("I'm a custom log message"), 
	!1
}), 


$("#bootstrap").on("click", function () {
	return reset(), $("#toggleCSS").attr("href", "../themes/alertify.bootstrap.css"), alertify.prompt("Prompt dialog with bootstrap theme", function (a) {
		a ? alertify.success("You've clicked OK") : alertify.error("You've clicked Cancel")
	}, "Default Value"), !1
});