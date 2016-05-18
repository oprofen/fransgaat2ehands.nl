function jInsertFieldValue(value, id) {
	var $ = jQuery.noConflict();
	var old_value = $("#" + id).val();
	if (old_value != value) {
		var $elem = $("#" + id);
		$elem.val(value);
		$elem.trigger("change");
		if (typeof($elem.get(0).onchange) === "function") {
			$elem.get(0).onchange();
		}
		jMediaRefreshPreview(id);
	}
}

function jMediaRefreshPreview(id) {
	var $ = jQuery.noConflict();
	var value = $("#" + id).val();
	/*Made it work*/
	var number = "";
	var regex = new RegExp(/-\d+\b/, 'g');
	var found = id.search(regex);
	if(~found){
		number = id.substring(found);
		id = id.substring(0, found);

	}
	var $img = $("#" + id + "_preview" + number);
	var basepath = $("#" + id + number).data("basepath");

	if ($img.length) {
		if (value) {
			$img.attr("src", basepath + value);
			$("#" + id + "_preview_empty" + number).hide();
			$("#" + id + "_preview_img" + number).show()
		} else {
			$img.attr("src", "");
			$("#" + id + "_preview_empty" + number).show();
			$("#" + id + "_preview_img" + number).hide();
		}
	}
}

function jMediaRefreshPreviewTip(tip)
{
	var $ = jQuery.noConflict();
	var $tip = $(tip);
	var $img = $tip.find("img.media-preview");

	$img.each(function(index, value) {
		$tip.find("div.tip").css("max-width", "none");
		var id = $(this).attr("id");
		id = id.substring(0, id.length - "_preview".length);
		jMediaRefreshPreview(id);
		$tip.show(this);
	});
}

// JQuery for tooltip for INPUT showing whole image path
function jMediaRefreshImgpathTip(tip, els)
{
	var $ = jQuery.noConflict();
	var $tip = $(tip);
	$tip.css("max-width", "none");
	var $imgpath = $(els).val();
	$("#TipImgpath").html($imgpath);

	if ($imgpath.length) {
		$tip.show();
	} else {
		$tip.hide();
	}
}