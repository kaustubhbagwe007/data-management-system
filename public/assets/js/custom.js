$(document).ready(function () {

    $('#login-form, #role-form, #user-form, #category-form, #product-form').validate();
})

// whenever user deletes any record (on all index page) a pop is shown to confirm delete operations 
function destroyRecord() {

    let destroyRecordForm = $('#destroy-record')

    let msg = 'Confirm delete this record ?'

    if (destroyRecordForm.data('alert-msg')) {

        msg = destroyRecordForm.data('alert-msg')
    }

    if (confirm(msg)) {

        destroyRecordForm.submit();
    }
}

// populate category details in category modal on view.products.index page
function populateCategoryModal(name, description) {

    $("#category-detail-modal #category-name").text(name)
    $("#category-detail-modal #category-description").text(description)
}