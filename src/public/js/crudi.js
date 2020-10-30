async function askFroConfirm() {
    let result = await Swal.fire({
        title: 'Do you want to proceed?',
        text:"You cannot undo this action",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
        confirmButtonColor: '#2e7d32',
        cancelButtonColor: '#333',
        icon:"warning",
    });
    if (!result.value) {
        return false;
    }
    return  true;
}
$(document).ready(function () {
    // delete item
    $(document).on("click",".crudi-deleteItem",async function () {
        if (!await askFroConfirm()) {
            return;
        }
        let $this = $(this);
        let curUrl = window.location.href;
        let target_item_id = $(this).data('id');
        let delete_url = encodeURI(curUrl + '/delete/' + target_item_id).replace(/([^:]\/)\/+/g, "$1");
        $.ajax({
            url:delete_url,
            success:function () {
                Swal.fire("Item Deleted !","Your Item Has been deleted Successfully",'success');
                $this.parent().parent().parent().remove();
            },
            error:function () {
                Swal.fire("Failed","Something is preventing us from deleting this item",'error');
            }
        })
    });

    // edit item
    $(document).on("click",".crudi-editItem",async function () {
        let curUrl = window.location.href;
        let target_item_id = $(this).data('id');
        let edit_url = encodeURI(curUrl + '/update/' + target_item_id).replace(/([^:]\/)\/+/g, "$1");
        window.location.assign(edit_url);
    });
});
