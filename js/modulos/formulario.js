"use strict";

$(document).ready(function() {
	$("input").filter(":button").click(function() {
		var inputId = $(this).attr("data-for");

		$("#"+inputId).trigger("click");
		$("span").filter("[data-for='"+inputId+"']").html("Selecione um arquivo");
	});

	$("input").filter(":file").change(function() {
		var file = this.files[0];
		var inputId = this.id;

		if (file !== undefined)
			$("span").filter("[data-for='"+inputId+"']").html(file.name);
		else
			$("span").filter("[data-for='"+inputId+"']").html("Selecione um arquivo");
	});
});