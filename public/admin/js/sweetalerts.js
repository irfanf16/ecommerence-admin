/* 
|================================================
|  SWEET-ALERTS
|================================================
*/

// GENERAL
function sweetAlert(act, msg) {
    let action = act;
    let message = msg;

    if (action == "add") {
        swal({
            title: "Added!",
            text: message,
            icon: "success",
            timer: 3000,
            button: true,
            closeOnClickOutside: true,
            closeOnEsc: true,
        });
    } else if (action == "update") {
        swal({
            title: "Updated!",
            text: message,
            icon: "success",
            timer: 3000,
            button: true,
            closeOnClickOutside: true,
            closeOnEsc: true,
        });
    } else if (action == "delete") {
        swal({
            title: "Deleted!",
            text: message,
            icon: "error",
            timer: 3000,
            button: true,
            closeOnClickOutside: true,
            closeOnEsc: true,
        });
    }
}

// PASS WITH MESSAGE
function alertPassWithMsg(message) {
    let alertMessage = message;

    swal({
        title: "Success!",
        text: alertMessage,
        icon: "success",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// FAIL WITH MESSAGE
function alertFailWithMsg(message) {
    let alertMessage = message;

    swal({
        title: "Sorry!",
        text: alertMessage,
        icon: "error",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// ADDED
function alertAdded() {
    swal({
        title: "Success!",
        text: "Added Successfully",
        icon: "success",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// UPDATED
function alertUpdated() {
    swal({
        title: "Success!",
        text: "Updated Successfully",
        icon: "success",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// DELETED
function alertDeleted() {
    swal({
        title: "Success!",
        text: "Deleted Successfully",
        icon: "success",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// DELETED
function alertConfirmDelete() {
    swal({
        title: "Are You Sure!",
        text: "Do You Really Want to Delete It?",
        icon: "warning",
        dangerMode: true,
        buttons: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// WARNING
function alertWarning() {
    swal({
        title: "Sorry!",
        text: "Something Went Wrong",
        icon: "warning",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}

// INFO
function alertInfo() {
    swal({
        title: "Sorry!",
        text: "Something Went Wrong",
        icon: "info",
        timer: 3000,
        button: true,
        closeOnClickOutside: true,
        closeOnEsc: true,
    });
}