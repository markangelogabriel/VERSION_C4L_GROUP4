$(document).ready(function(){
	
});

function addTableRow(){
	var str = "<tr><td></td><td><input class = \"witness\" type=\"text\" name=\"witness[]\" size=\"40\"></td></tr>";
	$('.addtr').before(str);
	$('.witness').focus();
}

function showSuccessCrime() {
    $().toastmessage('showSuccessToast', "Successfully added a crime!");
}

function showSuccessReport() {
    $().toastmessage('showSuccessToast', "Successfully added a report!");
}

function showSuccessCriminal() {
    $().toastmessage('showSuccessToast', "Successfully added a criminal!");
}

function showStickySuccessToast() {
    $().toastmessage('showToast', {
        text     : 'Success Dialog which is sticky',
        sticky   : true,
        position : 'top-right',
        type     : 'success',
        closeText: '',
        close    : function () {
            console.log("toast is closed ...");
        }
    });

}
function showNoticeToast() {
    $().toastmessage('showNoticeToast', "Notice  Dialog which is fading away ...");
}
function showStickyNoticeToast() {
    $().toastmessage('showToast', {
         text     : 'Notice Dialog which is sticky',
         sticky   : true,
         position : 'top-right',
         type     : 'notice',
         closeText: '',
         close    : function () {console.log("toast is closed ...");}
    });
}
function showWarningToast() {
    $().toastmessage('showWarningToast', "Warning Dialog which is fading away ...");
}
function showStickyWarningToast() {
    $().toastmessage('showToast', {
        text     : 'Warning Dialog which is sticky',
        sticky   : true,
        position : 'top-right',
        type     : 'warning',
        closeText: '',
        close    : function () {
            console.log("toast is closed ...");
        }
    });
}
function showErrorToast() {
    $().toastmessage('showErrorToast', "Error Dialog which is fading away ...");
}
function showStickyErrorToast() {
    $().toastmessage('showToast', {
        text     : 'Error Dialog which is sticky',
        sticky   : true,
        position : 'top-right',
        type     : 'error',
        closeText: '',
        close    : function () {
            console.log("toast is closed ...");
        }
    });
}